using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using AppFarm.Models;
using Microsoft.AspNetCore.Authorization;

namespace AppFarm.Controllers
{
    [Authorize(AuthenticationSchemes = "Bearer")]
    [Route("api/[controller]")]
    [ApiController]
    public class CategoryMachinesController : ControllerBase
    {
        private readonly AppDbContext _context;

        public CategoryMachinesController(AppDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public async Task<ActionResult<IEnumerable<CategoryMachine>>> GetCategoryMachines()
        {
            return await _context.CategoryMachines.OrderBy(x=>x.name_category_machine).ToListAsync();
        }


    }
}
