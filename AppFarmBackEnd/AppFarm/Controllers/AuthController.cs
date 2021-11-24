using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using AppFarm.Services;
using AppFarmDto;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace AppFarm.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AuthController : ControllerBase
    {
        IConfiguration _configuration;
        IUserServices _userServices;
        public AuthController(IUserServices services, IConfiguration configuration)
        {
            _configuration = configuration;
            _userServices = services;
        }
        [HttpPost("register")]
        public async Task<IActionResult> RegisterAsync([FromBody] RegisterDto registerDto)
        {

            var result = await _userServices.RegisterUserAsync(registerDto);

            if (result.Succes)
                return Ok(result); // Status Code: 200 




            return BadRequest(result); // Status code: 400
        }
        [HttpPost("login")]
        public async Task<IActionResult> LoginAsync([FromBody] LoginDto loginDto)
        {


            var result = await _userServices.LoginUserAsync(loginDto);

            if (result.Succes)
                return Ok(result); // Status Code: 200 

            return BadRequest(result);

        }

        [HttpGet("confirmemail")]
        public async Task<IActionResult> ConfirmEmailAsync(string userId, string token)
        {
            var result = await _userServices.ConfirmEmailAsync(userId, token);

            if (result.Succes)
            {
                return Redirect($"{_configuration["UrlSettings:ClientUrl"]}/emailconfirm");

            }
            return BadRequest(result);
        }

        [HttpPost("ForgetPassword")]
        public async Task<IActionResult> ForgetPassword([FromBody] ForgetResetPasswordDto forget)
        {
            if (string.IsNullOrEmpty(forget.Email))
            {
                return NotFound();
            }
            var result = await _userServices.ForgetPasswordAsync(forget);
            if (result.Succes)
            {
                return Ok(result);
            }
            return BadRequest(result);
        }
        [HttpPost("reset")]
        public async Task<IActionResult> ResetPasswordAsync([FromBody] ForgetResetPasswordDto resetPasswordDto)
        {
            var result = await _userServices.ResetPasswordAsync(resetPasswordDto);
            if (result.Succes==true)
            {
                return Ok(result);
            }
            return BadRequest("bład");
        }

    }
}
