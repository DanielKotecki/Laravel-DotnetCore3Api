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
    public class UnitsController : ControllerBase
    {
        private readonly AppDbContext _context;

        public UnitsController(AppDbContext context)
        {
            _context = context;
        }

        [HttpGet("units")]
        public async Task<ActionResult<IEnumerable<Unit>>> GetUnits()
        {
            return await _context.Units.OrderBy(x=>x.unit_of_measure).ToListAsync();
        }

    }
}
