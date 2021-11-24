using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using AppFarm.Models;
using AppFarmDto;
using Microsoft.EntityFrameworkCore.Internal;
using System.Security.Cryptography.X509Certificates;
using System.Net;
using Microsoft.AspNetCore.Authorization;
using System.Security.Claims;

namespace AppFarm.Controllers
{
    [Authorize(AuthenticationSchemes = "Bearer")]
    [Route("api/[controller]")]
    [ApiController]
    public class MachinesController : ControllerBase
    {
        private readonly AppDbContext _context;
       
        public MachinesController(AppDbContext context)
        {
            _context = context;
        }
       
        [HttpGet("afteralert_insurance")]
        public async Task<ActionResult<List<AlertDto>>> Get_Afterinsurance()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var alerts = await _context.Machines.Where(x => x.AspNetUsersId == userN.Value).Where(x => x.insurance_date < DateTime.Now).Select(t => new AlertDto()
            {
                Id = t.Id,
                machine_id = t.machine_id,
                mark = t.mark,
                model = t.model,
                date = (DateTime)t.insurance_date,
                alertMessage = "Upłynął czas OC",

            }).ToListAsync();

            return Ok(alerts);

        }
        [HttpGet("afteralert_mot")]
        public async Task<ActionResult<List<AlertDto>>> Get_Afteralert_mot()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var alerts = await _context.Machines.Where(x => x.AspNetUsersId == userN.Value)
            .Where(x => x.mot_check < DateTime.Now).Select(t => new AlertDto()
            {
                Id = t.Id,
                machine_id = t.machine_id,
                mark = t.model,
                model = t.model,
                date = (DateTime)t.mot_check,
                alertMessage = "Upłynął termin Badania technicznego",

            }).ToListAsync();

            return Ok(alerts);

        }

        [HttpGet("alert_insurance")]
        public async Task<ActionResult<List<AlertDto>>> Get_insurance()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var alerts=await _context.Machines.Where(x => x.AspNetUsersId == userN.Value).Where(x=>x.insurance_date<=DateTime.Now.AddDays(30)).Where(x => x.insurance_date > DateTime.Now).Select(t=>new AlertDto() { 
            Id=t.Id,
                machine_id = t.machine_id,
                mark =t.mark,
            model=t.model,
            date= (DateTime)t.insurance_date,
            alertMessage="Niedługo czas na opłacenie OC",
            
            }).ToListAsync();
            
            return Ok(alerts);

        }
        [HttpGet("alert_mot")]
        public async Task<ActionResult<List<AlertDto>>> Get_alert_mot()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var alerts = await _context.Machines.Where(x => x.AspNetUsersId == userN.Value).Where(x => x.mot_check <= DateTime.Now.AddDays(30)).Where(x => x.mot_check > DateTime.Now).Where(x=>x.mot_check!=null).Select(t => new AlertDto()
            {
                Id = t.Id,
                machine_id=t.machine_id,
                mark = t.model,
                model = t.model,
                date = (DateTime)t.mot_check,
                alertMessage = "Niedługo czas na Badanie techniczne pojazdu",

            }).ToListAsync();

            return Ok(alerts);

        }
        [HttpGet("count_machine")]
        public async Task<IActionResult> GetCountMachine()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            return Ok(await _context.Machines.Where(x => x.AspNetUsersId == userN.Value).CountAsync());

        }

        [HttpGet("group_count")]
        public async Task<ActionResult> GetCountGroupMachine()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var zapytanie = await (from category in _context.CategoryMachines
                                   join machine in _context.Machines on category.Id equals machine.CategoryMachineId into grupa
                                   from p in grupa
                                   where p.AspNetUsersId == userN.Value
                                   group new { p,category.name_category_machine } by new { category.Id,category.name_category_machine } into grp
                                   select new CategoryMachineGroupDto()
                                   {
                                     name_category=grp.Key.name_category_machine,
                                     count_group=grp.Count()
                                   }).ToListAsync();
            return Ok(zapytanie);

        }

        [HttpGet("all_machine")]
        public async Task<ActionResult> GetAllMachine()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
           
            var zapytanie = await (from category in _context.CategoryMachines
                                   join machine in _context.Machines on category.Id equals machine.CategoryMachineId into grupa
                                   from p in grupa
                                   where p.AspNetUsersId==userN.Value
                                   select new
                                   {
                                       id = p.Id,
                                       machine_id=p.machine_id,
                                       mark = p.mark,
                                       model = p.model,
                                       name_category_machine = category.name_category_machine,
                                       year = p.year,
                                       power = p.power,
                                       power_need = p.power_need,
                                       working_width = p.working_width,
                                       insurance_date = p.insurance_date,
                                       mot_check = p.mot_check,
                                       attached = p.attached,
                                   }).ToListAsync();
            return Ok(zapytanie);
            
        }

        [HttpGet("category/{id_category}")]
        public async Task<ActionResult> GetMachines(int id_category)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var zapytanie = await (from category in _context.CategoryMachines
                                   join machine in _context.Machines on category.Id equals machine.CategoryMachineId into grupa
                                   from p in grupa
                                   where (p.CategoryMachineId == id_category) && (p.AspNetUsersId == userN.Value)
                                   select new
                                   {
                                       id = p.Id,
                                       machine_id=p.machine_id,
                                       mark = p.mark,
                                       model = p.model,
                                       name_category_machine = category.name_category_machine,
                                       year = p.year,
                                       power = p.power,
                                       power_need = p.power_need,
                                       capacity=p.capacity,
                                       working_width = p.working_width,
                                       insurance_date = p.insurance_date,
                                       mot_check = p.mot_check,
                                       attached = p.attached,
                                   }).ToListAsync();
            return Ok(zapytanie);
        }


        [HttpGet("machine/{name_machine_id}")]
        public async Task<ActionResult> GetMachinesId(int name_machine_id)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var zapytanie = await (from category in _context.CategoryMachines
                                   join machine in _context.Machines on category.Id equals machine.CategoryMachineId into grupa
                                   from p in grupa
                                   where (p.Id== name_machine_id) && (p.AspNetUsersId == userN.Value)
                                   select new
                                   {
                                       id = p.Id,
                                       machine_id=p.machine_id,
                                       mark = p.mark,
                                       model = p.model,
                                       category_id=p.CategoryMachineId,
                                       name_category_machine = category.name_category_machine,
                                       year = p.year,
                                       power = p.power,
                                       capacity=p.capacity,
                                       power_need = p.power_need,
                                       working_width = p.working_width,
                                       insurance_date = p.insurance_date,
                                       mot_check = p.mot_check,
                                       attached = p.attached,
                                   }).ToListAsync();
            return Ok(zapytanie);
        }

        [HttpPut("mod/{id}")]
        public async Task<IActionResult> PutMachine(int id, MachineDto machineDto)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            if (!MachineExists(id))
            {
                return NotFound();
            }
            else
            {
               var machine_modified = await _context.Machines.FindAsync(id);
                if (machine_modified.AspNetUsersId==userN.Value)
                {
                    machine_modified.machine_id = machineDto.machine_id;
                    machine_modified.mark = machineDto.mark;
                    machine_modified.model = machineDto.model;
                    machine_modified.year = machineDto.year;
                    machine_modified.power = machineDto.power;
                    machine_modified.power_need = machineDto.power_need;
                    machine_modified.working_width = machineDto.working_width;
                    machine_modified.capacity = machineDto.capacity;
                    machine_modified.insurance_date = machineDto.insurance_date;
                    machine_modified.mot_check = machineDto.mot_check;
                    machine_modified.attached = machineDto.attached;
                    machine_modified.CategoryMachineId = machineDto.CategoryMachineId;
                    _context.Machines.Update(machine_modified);
                    await _context.SaveChangesAsync();
                    return Ok("Sukces");
                }
                
            }
            return Content("Error");
        }

       
        [HttpPost("add_machine")]
        public async Task<ActionResult<Machine>> PostMachine(Machine machine)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            machine.AspNetUsersId =userN.Value;
            _context.Machines.Add(machine);
            await _context.SaveChangesAsync();

            return Ok(machine);
        }

        // DELETE: api/Machines/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<Machine>> DeleteMachine(int id)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var machine = await _context.Machines.FindAsync(id);
            if (machine == null)
            {
                return NotFound();
            }
            if (machine.AspNetUsersId==userN.Value)
            {
                _context.Machines.Remove(machine);
                await _context.SaveChangesAsync();
                return Ok();
            }

            return NotFound();
        }

        private bool MachineExists(int id)
        {
            return _context.Machines.Any(e => e.Id == id);
        }
    }
}
