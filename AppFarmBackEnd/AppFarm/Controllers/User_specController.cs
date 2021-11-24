using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using AppFarm.Models;
using System.Security.Claims;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Identity;
using AppFarmDto;

namespace AppFarm.Controllers
{
    [Authorize(AuthenticationSchemes = "Bearer")]
    [Route("api/[controller]")]
    [ApiController]
    public class User_specController : ControllerBase
    {
        private readonly AppDbContext _context;
        private readonly UserManager<IdentityUser> _userManager;
        public User_specController(AppDbContext context, UserManager<IdentityUser> userManager)
        {
            _context = context;
            _userManager = userManager;
        }

        // GET: api/User_spec
        [HttpGet]
        public async Task<ActionResult<IEnumerable<User_specDto>>> Getuser_Specs()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            return await _context.user_Specs.Where(i=>i.AspNetUsersId==userN.Value).Select(x=>new User_specDto { 
            name=x.name,
            surname=x.surname,
            address=x.address,
            city=x.city,
            country=x.country
            }).ToListAsync();
        }


        [HttpPut("mod_user")]
        public async Task<IActionResult> PutUser_spec(User_specDto user_specDto)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var spec_user = _context.user_Specs.Where(x => x.AspNetUsersId == userN.Value).FirstOrDefault();
            if (spec_user == null)
            {
                return NotFound();
            }
            else
            {
                spec_user.name = user_specDto.name;
                spec_user.surname = user_specDto.surname;
                spec_user.city = user_specDto.city;
                spec_user.address = user_specDto.address;
                spec_user.country = user_specDto.country;
                _context.user_Specs.Update(spec_user);
                await _context.SaveChangesAsync();
                return Ok("Sukces");
            }
            
        }







    }
}
