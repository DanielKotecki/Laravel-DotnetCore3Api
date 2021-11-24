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
    public class PlotsController : ControllerBase
    {
        private readonly AppDbContext _context;
        public PlotsController(AppDbContext context)
        {
            _context = context;
        }

        ////Agregacja
        ///
        ///Zlicznie działek ile jest

        [HttpGet("count_plot")]
        public async Task<IActionResult> GetCountPlot()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            return Ok(await _context.Plots.Where(x => x.AspNetUsersId == userN.Value).CountAsync());

        }
        ///Zliczanie ile danego typu
        [HttpGet("group_count")]
        public async Task<ActionResult> GetCountGroupPlot()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var zapytanie = await (from type in _context.plot_Types
                                   join plot in _context.Plots on type.Id equals plot.Plot_typeId into grupa
                                   from p in grupa
                                   where p.AspNetUsersId == userN.Value
                                   group new { p, type.type_p } by new { type.Id, type.type_p } into grp
                                   select new PlotTypeCount()
                                   {
                                       nameType = grp.Key.type_p,
                                       countType = grp.Count()
                                   }).ToListAsync();
            return Ok(zapytanie);

        }


        ///Wszystkie działki
        [HttpGet("all_plot")]
        public async Task<ActionResult<IEnumerable<Plot>>> GetPlots()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var zapytanie = await (from type_plot in _context.plot_Types
                                   join plot in _context.Plots on type_plot.Id equals plot.Plot_typeId into grupa
                                   from p in grupa
                                   where p.AspNetUsersId == userN.Value
                                   select new PlotDto()
                                   {
                                       Id = p.Id,
                                       number_plot = p.number_plot,
                                       city = p.city,
                                       area_hectare = p.area_hectare,
                                       rent = p.rent,
                                       Plot_typeId = p.Plot_typeId,
                                       Plot_type_name = type_plot.type_p
                                   }).ToListAsync();
            return Ok(zapytanie);


        }




        ///Jedna działka

        [HttpGet("one_plot/{id_plot}")]
        public async Task<ActionResult<IEnumerable<Plot>>> GetOnePlot(int id_plot)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var zapytanie = await (from type_plot in _context.plot_Types
                                   join plot in _context.Plots on type_plot.Id equals plot.Plot_typeId into grupa
                                   from p in grupa
                                   where (p.Id == id_plot) && (p.AspNetUsersId == userN.Value)
                                   select new PlotDto()
                                   {
                                       Id = p.Id,
                                       number_plot = p.number_plot,
                                       city = p.city,
                                       area_hectare = p.area_hectare,
                                       rent = p.rent,
                                       Plot_typeId = p.Plot_typeId,
                                       Plot_type_name = type_plot.type_p
                                   }).ToListAsync();
            return Ok(zapytanie);

        }
        ///Działki danej kategorii
        ///

        [HttpGet("plot_by_type/{id_type}")]
        public async Task<ActionResult<IEnumerable<Plot>>> Getbytype(int id_type)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var zapytanie = await (from type_plot in _context.plot_Types
                                   join plot in _context.Plots on type_plot.Id equals plot.Plot_typeId into grupa
                                   from p in grupa
                                   where (p.Plot_typeId == id_type) && (p.AspNetUsersId == userN.Value)
                                   select new PlotDto()
                                   {
                                       Id = p.Id,
                                       number_plot = p.number_plot,
                                       city = p.city,
                                       area_hectare = p.area_hectare,
                                       rent = p.rent,
                                       Plot_typeId = p.Plot_typeId,
                                       Plot_type_name = type_plot.type_p
                                   }).ToListAsync();
            return Ok(zapytanie);

        }




        ///Dodawanie

        [HttpPost("add_plot")]
        public async Task<ActionResult<Plot>> PostPlot(Plot plot)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            plot.AspNetUsersId = userN.Value;
            _context.Plots.Add(plot);
            await _context.SaveChangesAsync();
            return Ok(plot);
        }


        ///Modyfikacja 
        [HttpPut("mod_plot/{id_put}")]
        public async Task<ActionResult> PutPlot(int id_put,Plot_modifiedDto  plot_ModifiedDto)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            if (!PlotExists(id_put))
            {
                return NotFound();
            }
            else
            {
                var plot = await _context.Plots.FindAsync(id_put);
                if (plot.AspNetUsersId==userN.Value)
                {
                    plot.number_plot = plot_ModifiedDto.number_plot;
                    plot.city = plot_ModifiedDto.city;
                    plot.area_hectare = plot_ModifiedDto.area_hectare;
                    plot.rent = plot_ModifiedDto.rent;
                    plot.Plot_typeId = plot_ModifiedDto.Plot_typeId;
                    _context.Plots.Update(plot);
                    await _context.SaveChangesAsync();
                    return Ok("Sukces");
                }
            }
            return NoContent();
        }
        [HttpPut("rent/mod_plot/{id_put}")]
        public async Task<ActionResult> PutRent(int id_put, Plot_modifiedDto plot_ModifiedDto)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            if (!PlotExists(id_put))
            {
                return NotFound();
            }
            else
            {
                var plot = await _context.Plots.FindAsync(id_put);
                if (plot.AspNetUsersId == userN.Value)
                {
                    plot.rent = plot_ModifiedDto.rent;
                    _context.Plots.Update(plot);
                    await _context.SaveChangesAsync();
                    return Ok("Sukces");
                }
            }
            return NoContent();
        }
        ///usuwanie
        ///
        [HttpDelete("deleteplot/{id_deletePlot}")]

        public async Task<ActionResult<Plot>> DeletePlot(int id_deletePlot)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var plot = await _context.Plots.FindAsync(id_deletePlot);
            if (plot==null)
            {
                 return NotFound();
            }
            if (plot.AspNetUsersId == userN.Value)
            {
               await DeleteAllPlotWorks(id_deletePlot, userN.Value);
                await DeleteRent(id_deletePlot, userN.Value);
                _context.Plots.Remove(plot);
                await _context.SaveChangesAsync();
                return Ok("Sukces");
            }
            return NotFound();
        }
        [NonAction]

        public async Task<ActionResult<Plot_works>> DeleteAllPlotWorks(int id_delete,string userAsp)
        {
            var plotWorks = await _context.plot_Works.Where(x => x.PlotId == id_delete).Where(x => x.AspNetUsersId == userAsp).ToListAsync();
            if (plotWorks == null)
            {
                return NotFound();
            }
            else
            {
                _context.plot_Works.RemoveRange(plotWorks);
                await _context.SaveChangesAsync();
                return Ok();
            }
            
        }
        [NonAction]

        public async Task<ActionResult<Rent_spec>> DeleteRent(int id_delete, string userAsp)
        {
            var rentdelete = await _context.rent_Specs.Where(x => x.PlotId == id_delete).Where(x => x.AspNetUsersId == userAsp).ToListAsync();
            if (rentdelete==null)
            {
                return NotFound();
            }else
            {
                _context.rent_Specs.RemoveRange(rentdelete);
                await _context.SaveChangesAsync();
                return Ok();
            }
        }

        [NonAction]

        private bool PlotExists(int id)
        {
            return _context.Plots.Any(e => e.Id == id);
        }
    }
}
