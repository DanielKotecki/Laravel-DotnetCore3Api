using AppFarm.Models;
using AppFarmDto;
using Microsoft.AspNetCore.Mvc;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Services
{
   public interface IUserServices
    {
        Task<ResponseDto> LoginUserAsync(LoginDto loginDto);
        Task<ResponseDto> RegisterUserAsync( RegisterDto registerDto);
        Task<ResponseDto> ConfirmEmailAsync(string userId, string token);
        Task<ResponseDto> ForgetPasswordAsync(ForgetResetPasswordDto forget);
        Task<ResponseDto> ResetPasswordAsync(ForgetResetPasswordDto resetPasswordDto);
        Task<ActionResult<User_spec>> Creat_user(User_spec user_spec);
        Task<ResponseDto> DeleteUserAsync(DeleteUserDto deleteUserDto);
    }
}
