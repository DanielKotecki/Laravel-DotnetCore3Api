using AppFarm.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class CategoryStorehousesController : ControllerBase
    {
        private readonly AppDbContext _context;

        public CategoryStorehousesController(AppDbContext context)
        {
            _context = context;
        }

        [HttpGet("categorystorehouse")]
        public async Task<ActionResult<IEnumerable<CategoryStorehouse>>> GetCategoryStorehouses()
        {
            return await _context.CategoryStorehouses.OrderBy(x=>x.Category).ToListAsync();
        }
    }
}
