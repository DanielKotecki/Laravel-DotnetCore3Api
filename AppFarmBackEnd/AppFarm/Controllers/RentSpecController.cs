using AppFarm.Models;
using AppFarmDto;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Server.HttpSys;
using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Security.Claims;
using System.Threading.Tasks;

namespace AppFarm.Controllers
{
    [Authorize(AuthenticationSchemes = "Bearer")]
    [Route("api/[controller]")]
    [ApiController]
    public class RentSpecController : ControllerBase
    {
        private readonly AppDbContext _context;

        public RentSpecController(AppDbContext context)
        {
            _context = context;
        }

        [HttpGet("alert_rent")]
        public async Task<ActionResult<List<AlertWorkDto>>> Get_alert_rent()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var alertRent = await (from plot in _context.Plots
                               join rent in _context.rent_Specs on plot.Id equals rent.PlotId into grupa
                               from p in grupa
                               where ((p.AspNetUsersId == userN.Value) && (p.end_date <= DateTime.Now.AddDays(90)) && (p.end_date > DateTime.Now) && (p.end_date != null))
                               select new Alert_RentDto()
                               {
                                   Id = p.Id,
                                   plotId = plot.Id,
                                   numberPlot = plot.number_plot,
                                   city = plot.city,
                                   dateEnd = p.end_date,
                                   days_to_end = (p.end_date - DateTime.Now).Days,
                                   alertMessage = "Niedługo kończy się dzierżawa",
                               }
                               ).ToListAsync();
            return Ok(alertRent);
        }

        //Wyświetlnie Rent Spec danej działki
        [HttpGet("rent_one/{id_plot}")]
        public async Task<ActionResult> GetRent(int id_plot)
        { 
            DateTime zeroTime = new DateTime(1, 1, 1);
            
            var user = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var zapytanie = await (from spec in _context.rent_Specs
                                   where (spec.PlotId == id_plot) && (spec.AspNetUsersId == user.Value)
                                   select new Rent_specDto()
                                   {
                                       Id = spec.Id,
                                       PlotId = spec.PlotId,
                                       start_rent = spec.start_rent,
                                       end_date = spec.end_date,
                                       year_rent = (zeroTime + (spec.end_date - spec.start_rent)).Year - 1,
                                      date_time_month = (spec.end_date.Month - spec.start_rent.Month),
                                      date_time_days= (spec.end_date.Day - spec.start_rent.Day),
                                      ground_rent_cost = spec.ground_rent_cost,
                                   }).ToListAsync();
            return Ok(zapytanie);
        }

        //Usuwanie rentSpec
        [HttpDelete("deleterent/{id_deleterent}")]

        public async Task<ActionResult<Rent_spec>> DeletePlotRent(int id_deleterent)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var rent =  await _context.rent_Specs.Where(x=>x.PlotId==id_deleterent).Where(x=>x.AspNetUsersId==userN.Value).FirstOrDefaultAsync();
            if (rent == null)
            {
                return NotFound();
            }
            else
            {
                _context.rent_Specs.Remove(rent);
                await _context.SaveChangesAsync();
                return Ok("Sukces");
            }
           
        }

        [HttpPut("mod_rent/{id_put}")]
        public async Task<ActionResult> PutPlotRent(int id_put, RentSpecmodifiedDto rentSpecmodifiedDto)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var rent_spec = await _context.rent_Specs.FindAsync(id_put);
            if (rent_spec.AspNetUsersId == userN.Value)
            {
                rent_spec.start_rent = rentSpecmodifiedDto.start_rent;
                rent_spec.end_date = rentSpecmodifiedDto.end_date;
                rent_spec.ground_rent_cost = rentSpecmodifiedDto.ground_rent_cost;
                _context.rent_Specs.Update(rent_spec);
                await _context.SaveChangesAsync();
                return Ok("Sukces");
            }

            return NoContent();

        }

            //Dodanie Rent Spec
            [HttpPost("add_rent")]
        public async Task<ActionResult<Rent_spec>> PostRentSpec(Rent_spec rent_Spec)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var rentcheck = await _context.rent_Specs.Where(x => x.PlotId == rent_Spec.PlotId).Where(x => x.AspNetUsersId == userN.Value).FirstOrDefaultAsync();
            if (rentcheck!=null)
            {
                return Ok("Bład");
            }
           rent_Spec.AspNetUsersId = userN.Value;
            _context.rent_Specs.Add(rent_Spec);
            await _context.SaveChangesAsync();
            return Ok(rent_Spec);
        }
    }
}
