using AppFarm.Models;
using AppFarmDto;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.WebUtilities;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.Configuration;
using Microsoft.IdentityModel.Tokens;
using System;
using System.Collections.Generic;
using System.IdentityModel.Tokens.Jwt;
using System.Linq;
using System.Security.Claims;
using System.Text;
using System.Threading.Tasks;

namespace AppFarm.Services
{
    public class UserServices : IUserServices
    {
        private IConfiguration _configuration;
        private UserManager<IdentityUser> _userMenager;
        private IMailSend _mailSend;
        private  AppDbContext _context;
        public UserServices(UserManager<IdentityUser> userMenager,IConfiguration configuration,IMailSend mailSend,AppDbContext context)
        {
            _userMenager = userMenager;
            _configuration = configuration;
            _mailSend = mailSend;
            _context = context;
        }
       
        public async Task<ResponseDto> LoginUserAsync(LoginDto loginDto)
        {
            var loginUser = await _userMenager.FindByEmailAsync(loginDto.Email); 
            var result = await _userMenager.CheckPasswordAsync(loginUser, loginDto.Password);
            if ((loginUser!=null)&&(result==true))
            {
                if (loginUser.EmailConfirmed==false)
                {
                    var EmailToken = await _userMenager.GenerateEmailConfirmationTokenAsync(loginUser);
                    var EncodeToken = Encoding.UTF8.GetBytes(EmailToken);
                    var ValidateToken = WebEncoders.Base64UrlEncode(EncodeToken);
                    //potwierdzenie konta
                    string urlConfirm = $"{_configuration["UrlSettings:ApiUrl"]}/api/auth/confirmemail?userid={loginUser.Id}&token={ValidateToken}";
                    await _mailSend.SendEmailAsync(loginUser.Email, "Ponowna prośba o potwierdzenie maila dla konta FarmMan", $"<p>Witaj nowy użytkowniku.</p><br>Aby móc sie zalogować potwierdz maila poprzez kliknięcie w link:<a href='{urlConfirm}'>Kliknij aby potwierdzić konto</a><br><br>Z poważaniem,<br>Zespół FarmMan.");
                    return new ResponseDto {
                        Message = "Email nie jest potwierdzony",
                        Succes = false
                    };
                }
                var claims = new[]
              {
                new Claim(ClaimTypes.NameIdentifier, loginUser.Id),
                new Claim(ClaimTypes.Email,loginUser.Email)
              };
                var key = new SymmetricSecurityKey(Encoding.UTF8.GetBytes(_configuration["AuthSettings:Key"]));
                var creds = new SigningCredentials(key, SecurityAlgorithms.HmacSha512Signature);
                var token = new SecurityTokenDescriptor
                {
                    Subject = new ClaimsIdentity(claims),
                    Expires = DateTime.Now.AddHours(12),
                    SigningCredentials = creds
                };
                var tokenHandler = new JwtSecurityTokenHandler();
                var tokenReturn = tokenHandler.CreateToken(token);
                string message = tokenHandler.WriteToken(tokenReturn);
                return new ResponseDto
                {
                    Message = message,
                    Succes = true
                };
            }
            return new ResponseDto
            {
                Message = "Email lub hasło jest nie prawidłowe",
                Succes = false
            };
        }

        public async Task<ResponseDto> RegisterUserAsync(RegisterDto registerDto)
        {
            if (registerDto.Password != registerDto.ConfirmPassword)
            {
                return new ResponseDto
                {
                    Message = "Hasła nie są takie same",
                    Succes = false,
                };
            }
            var newUser = new IdentityUser
            {
                Email = registerDto.Email,
                UserName = registerDto.Email,
            };
            var response = await _userMenager.CreateAsync(newUser, registerDto.Password);
            if (response.Succeeded)
            {
                var EmailToken = await _userMenager.GenerateEmailConfirmationTokenAsync(newUser);
                var EncodeToken = Encoding.UTF8.GetBytes(EmailToken);
                var ValidateToken = WebEncoders.Base64UrlEncode(EncodeToken);
                //potwierdzenie konta
                string urlConfirm=$"{_configuration["UrlSettings:ApiUrl"]}/api/auth/confirmemail?userid={newUser.Id}&token={ValidateToken}";
               await _mailSend.SendEmailAsync(newUser.Email, "Potwierdzenie maila do konta FarmMan", $"<p>Witaj nowy użytkowniku.</p><br>Aby móc sie zalogować potwierdz maila poprzez kliknięcie w link:<a href='{urlConfirm}'>Kliknij tutaj</a><br><br>Z poważaniem,<br>Zespół FarmMan.");
                var specUser = new User_spec
                {
                    AspNetUsersId = newUser.Id
                };
                await Creat_user(specUser);
                return new ResponseDto
                {
                    Succes = true,
                    Message = "Konto zostało utworzone"
                };
            }

            return new ResponseDto
            {
                Message = "Email zajęty ",
                Succes = false,
            };

        }
        public async Task<ResponseDto> ConfirmEmailAsync(string userId, string token)
        {
            var userConfirm =await _userMenager.FindByIdAsync(userId);
            if (userConfirm==null)
            {
                return new ResponseDto
                {
                    Message = "Nie znaleziono użytkonika błąd",
                    Succes = false
                };
            }
            var decodedToken = WebEncoders.Base64UrlDecode(token);
            string normalToken = Encoding.UTF8.GetString(decodedToken);
            var response = await _userMenager.ConfirmEmailAsync(userConfirm, normalToken);
            if (!response.Succeeded)
            {
                return new ResponseDto
                {
                    Message = "Błąd potwierdzenia",
                    Succes = false
                };
            }
            return new ResponseDto
            {
                Message = "Konto potwierdzone",
                Succes = true
            };

        }

        public async Task<ResponseDto> ForgetPasswordAsync(ForgetResetPasswordDto forget)
        {
            var userForget = await _userMenager.FindByEmailAsync(forget.Email);
            if (userForget==null)
            {
                return new ResponseDto
                {
                    Message = "Użytkownik o takim emailu nie istnieje",
                    Succes = false
                };
            }
            var Token = await _userMenager.GeneratePasswordResetTokenAsync(userForget);
            var EncodedToken = Encoding.UTF8.GetBytes(Token);
            var ValidToken = WebEncoders.Base64UrlEncode(EncodedToken);
            string urlReset = $"{_configuration["UrlSettings:ClientUrl"]}/reset/{forget.Email}/{ValidToken}";
            await _mailSend.SendEmailAsync(forget.Email, "Zmiana hasła w aplikacji FarmMan",
                $"<p>Witaj użytkowniku.</p><br>Aby dokończyć proces zmiany hasła:<a href='{urlReset}'>kliknij tutaj.</a><br><br>Z poważaniem,<br>Zespół FarmMan.");
            return new ResponseDto
            {
                Message="Informacja o zmianie hasła została wysłana na maila",
                Succes=true
            };
        }
        public async Task<ResponseDto> ResetPasswordAsync(ForgetResetPasswordDto resetPasswordDto)
        {
            var userReset = await _userMenager.FindByEmailAsync(resetPasswordDto.Email);
            if (userReset==null)
            {
             return new ResponseDto
                        {
                            Message = "Błąd niedziała",
                            Succes = false
                        };
            }
       
            if (resetPasswordDto.NewPassword!=resetPasswordDto.ConfirmNewPassword)
            {
                return new ResponseDto
                {
                    Message = "Hasła nie są takie same",
                    Succes = false
                };
            }
            ///
            var decodedToken = WebEncoders.Base64UrlDecode(resetPasswordDto.Token);
            var normalToken = Encoding.UTF8.GetString(decodedToken);
            var result = await _userMenager.ResetPasswordAsync(userReset, normalToken, resetPasswordDto.NewPassword);
            //musi być tutaj if czy działa
            if (result.Succeeded)
            {
                 return new ResponseDto
                 {
                     Message = "Hasło zmienione",
                     Succes = true
                 };
            }
            return new ResponseDto
            {
                Message = "Błąd niedziała",
                Succes = false
            };

        }

        public async Task<ResponseDto> DeleteUserAsync(DeleteUserDto deleteUserDto)
        {
            var user = await _userMenager.FindByIdAsync(deleteUserDto.IdUser);
            if (user==null)
            {
                return new ResponseDto
                {
                    Message = "Użytkownik nie znaleziony.",
                    Succes = false
                };
            }
            if (deleteUserDto.Password!=deleteUserDto.ConfirmPassword)
            {
                return new ResponseDto
                {
                    Message="Hasła nie są takie same.",
                    Succes=false
                };
            }
            var result = await _userMenager.CheckPasswordAsync(user, deleteUserDto.Password);
            if (result==true)
            {
                
                if (user.EmailConfirmed==true)
                {
                    var delete = await _userMenager.DeleteAsync(user);
                    //Kod funckcji usuwające tabele
                   await  delete_on_tabel(user.Id);

                    //
                    await _mailSend.SendEmailAsync(user.Email, "Usunięto konto", "<h1>Twoje konto zostało usunięte z powodzeniem</h1>");
                    return new ResponseDto
                    {
                    Message="Konto usunięte z sukcesem.",
                    Succes=true
                    };
                }
                var EmailToken = await _userMenager.GenerateEmailConfirmationTokenAsync(user);
                var EncodeToken = Encoding.UTF8.GetBytes(EmailToken);
                var ValidateToken = WebEncoders.Base64UrlEncode(EncodeToken);
                //potwierdzenie konta
                string urlConfirm = $"{_configuration["UrlSettings:ApiUrl"]}/api/auth/confirmemail?userid={user.Id}&token={ValidateToken}";
                await _mailSend.SendEmailAsync(user.Email, "Potwierdzenie Konta", $"<a href='{urlConfirm}'>Clicking here</a>");
                return new ResponseDto
                {
                    Message = "Konto musi być potwierdzone.",
                    Succes = false
                };

            }
            return new ResponseDto
            {
                Message="Hasło nie porawne!",
                Succes=false
            };
            
        }

        private async Task<ActionResult<bool>> delete_on_tabel(string id)
        {
            var user_spec = await _context.user_Specs.Where(x => x.AspNetUsersId == id).ToListAsync();
            _context.RemoveRange(user_spec);
            await _context.SaveChangesAsync();

            var machines = await _context.Plots.Where(x => x.AspNetUsersId == id).ToListAsync();
            _context.RemoveRange(machines);
            await _context.SaveChangesAsync();

            var plotwork = await _context.plot_Works.Where(x => x.AspNetUsersId == id).ToListAsync();
            _context.RemoveRange(plotwork);
            await _context.SaveChangesAsync();

            var rentSpec = await _context.rent_Specs.Where(x => x.AspNetUsersId == id).ToListAsync();
            _context.RemoveRange(rentSpec);
            await _context.SaveChangesAsync();

            var animals = await _context.Animals.Where(x => x.AspNetUsersId == id).ToListAsync();
            _context.RemoveRange(animals);
            await _context.SaveChangesAsync();

            var Storehouse = await _context.plot_Works.Where(x => x.AspNetUsersId == id).ToListAsync();
            _context.RemoveRange(Storehouse);
            await _context.SaveChangesAsync();
            return true;

        }

        public async Task<ActionResult<User_spec>> Creat_user(User_spec user_spec)
        {
            _context.user_Specs.Add(user_spec);
            await _context.SaveChangesAsync();
            return user_spec;
        }
    }
}
