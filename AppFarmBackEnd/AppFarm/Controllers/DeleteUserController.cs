using AppFarm.Services;
using AppFarmDto;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Claims;
using System.Threading.Tasks;

namespace AppFarm.Controllers
{
    [Authorize(AuthenticationSchemes = "Bearer")]
    [Route("api/[controller]")]
    [ApiController]
    public class DeleteUserController : ControllerBase
    {
        IConfiguration _configuration;
        IUserServices _userServices;
        public DeleteUserController(IUserServices services, IConfiguration configuration)
        {
            _configuration = configuration;
            _userServices = services;
        }
        [HttpPost()]
        public async Task<IActionResult> DeleteUserAsync([FromBody] DeleteUserDto deleteUserDto)
        {
            var userId = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            deleteUserDto.IdUser=userId.Value;
            var result=await _userServices.DeleteUserAsync(deleteUserDto);
            return Ok(result);
        }
    }
}
