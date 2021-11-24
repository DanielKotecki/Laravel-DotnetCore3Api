using AppFarm.Models;
using AppFarmDto;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
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
    public class Plot_worksController : ControllerBase
    {
        private readonly AppDbContext _context;
        public Plot_worksController(AppDbContext context)
        {
            _context = context;
        }
        [HttpGet("alert_work")]
        public async Task<ActionResult<List<AlertWorkDto>>> Get_alert_work()
        {
        var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier); 
            
            var alert = await (from plot in _context.Plots
                               join work in _context.plot_Works on plot.Id equals work.PlotId into grupa from p in grupa
                               where ((p.AspNetUsersId==userN.Value)&&(p.end_working<=DateTime.Now.AddDays(7))&&(p.end_working > DateTime.Now)&&(p.status!="Zakończone"))select new AlertWorkDto()
                               {
                                   Id = p.Id,
                                   plotId=plot.Id,
                                   numberPlot=plot.number_plot,
                                   city=plot.city,
                                   dateEnd = p.end_working,
                                   work_description = p.work_description,
                                   days_to_end=(p.end_working-DateTime.Now).Days,
                                   alertMessage = "Niedługo czas na wykonanie pracy",
                               }
                               ).ToListAsync();
            return Ok(alert);
        }
            //jedna praca
            [HttpGet("work/{id_work}/{id_plot}")]
        public async Task<ActionResult<IEnumerable<Plot_works>>> GetworkPlot(int id_work,int id_plot)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            return await _context.plot_Works.Where(x => x.PlotId == id_plot).Where(x => x.AspNetUsersId == userN.Value).Where(x=>x.Id==id_work).ToListAsync();
            

        }

        //Prace na konkretnej działce
        [HttpGet("workonplot/{id_plot}")]
        public async Task<ActionResult<IEnumerable<Plot_works>>> GetworksPlot(int id_plot)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            return await _context.plot_Works.Where(x => x.PlotId == id_plot).Where(x => x.AspNetUsersId == userN.Value).ToListAsync();

        }

        //Dodanie Pracy
        [HttpPost("add_work/{id_plotadd}")]
        public async Task<ActionResult<Plot_works>> PostWork(int id_plotadd, Plot_works plot_Works)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            plot_Works.AspNetUsersId = userN.Value;
            plot_Works.PlotId = id_plotadd;
            _context.plot_Works.Add(plot_Works);
            await _context.SaveChangesAsync();
            return Ok("Sukces");
        }

        [HttpPut("mod_plotwork/{id_put}")]
        public async Task<IActionResult> PutWork(int id_put, Plot_work_modifiedDto plot_Work_ModifiedDto)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            if (!Plot_workExists(id_put))
            {
                return NotFound();
            }
            else
            {
                var plot_Work_Modified = await _context.plot_Works.FindAsync(id_put);
                if (plot_Work_Modified.AspNetUsersId == userN.Value)
                {
                    
                    plot_Work_Modified.work_description = plot_Work_ModifiedDto.work_description;
                    plot_Work_Modified.start_working = plot_Work_ModifiedDto.start_working;
                    plot_Work_Modified.end_working = plot_Work_ModifiedDto.end_working;
                    plot_Work_Modified.status = plot_Work_ModifiedDto.status;
                    _context.plot_Works.Update(plot_Work_Modified);
                    await _context.SaveChangesAsync();
                    return Ok("Sukces");
                }

            }
            return NoContent();
        }

        //Usuanie Pracy na działce
        [HttpDelete("deletework/{id_workdelete}")]
        public async Task<ActionResult<Plot_works>> DeleteWork(int id_workdelete)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var work = await _context.plot_Works.FindAsync(id_workdelete);
            if (work==null)
            {
                return NotFound();
            }
            if (work.AspNetUsersId==userN.Value)
            {
                _context.plot_Works.Remove(work);
                await _context.SaveChangesAsync();
                return Ok(work);
            }
            return NotFound();
        }



        private bool Plot_workExists(int id)
        {
            return _context.plot_Works.Any(e => e.Id == id);
        }

    }
}
