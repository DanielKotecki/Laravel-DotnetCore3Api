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
    public class StorehouseController : ControllerBase
    {

        private readonly AppDbContext _context;


        public StorehouseController(AppDbContext context)
        {
            _context = context;
        }

        //Agregacja ile danej kategorii
        [HttpGet("group_count")]
        public async Task<ActionResult> GetCountGroupStorehouse()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var zapytanie = await (from category in _context.CategoryStorehouses
                                   join material in _context.Material on category.Id equals material.CategoryStorehouseId into grupa
                                   from p in grupa
                                   where p.AspNetUsersId == userN.Value
                                   group new { p, category.Category } by new { category.Id, category.Category } into grp
                                   select new CategoryMachineGroupDto()
                                   {
                                       name_category = grp.Key.Category,
                                       count_group = grp.Count()
                                   }).ToListAsync();
            return Ok(zapytanie);


        }



        [HttpGet("count_material")]
        public async Task<IActionResult> GetCountMaterial()
        {
            var user = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            return Ok(await _context.Material.Where(x => x.AspNetUsersId == user.Value).CountAsync());
        }

        // api/Storehouse/all_material

        [HttpGet("all_material")]
        public async Task<ActionResult> GetAllMaterial()
        {
            var user = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            var zapytanie1 = await (from  storehouse in _context.Material
                                    join category in _context.CategoryStorehouses on storehouse.CategoryStorehouseId equals category.Id
                                    join unit in _context.Units on storehouse.UnitId equals unit.Id
                                    where storehouse.AspNetUsersId == user.Value
                                    select new
                                    {
                                        id = storehouse.Id,
                                        name = storehouse.name,
                                        description = storehouse.description,
                                        Category = category.Category,
                                        weight = storehouse.weight,
                                        expiry_date = storehouse.expiry_date,
                                        type_spray = storehouse.type_spray,
                                        application = storehouse.application,
                                        unit_of_measure = unit.unit_of_measure,
                                    }).ToListAsync();
           
 
            return Ok(zapytanie1);
        }

        //GET 

        [HttpGet("category/{id_category}")]
        public async Task<ActionResult> GetMaterials(int id_category)
        {
            var user = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var zapytanie2 = await (from storehouse in _context.Material
                                    join category in _context.CategoryStorehouses on storehouse.CategoryStorehouseId equals category.Id
                                    join unit in _context.Units on storehouse.UnitId equals unit.Id
                                    
                                    where (storehouse.CategoryStorehouseId == id_category) && (storehouse.AspNetUsersId == user.Value)
                                   select new
                                   {
                                       id = storehouse.Id,
                                       name = storehouse.name,
                                       description = storehouse.description,
                                       Category = category.Category,
                                       weight = storehouse.weight,
                                       expiry_date = storehouse.expiry_date,
                                       type_spray = storehouse.type_spray,
                                       application = storehouse.application,
                                       unit_of_measure = unit.unit_of_measure,

                                   }).ToListAsync();
            return Ok(zapytanie2);
        }

        [HttpGet("material/{id_material}")]
        public async Task<ActionResult> GetMaterialId(int id_material)
        {
            var user = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var zapytanie3 = await (from category in _context.CategoryStorehouses
                                    join material in _context.Material on category.Id equals material.CategoryStorehouseId
                                    into grupa from p in grupa
                                    join unit in _context.Units on p.UnitId equals unit.Id
                                    into zgrupa from z in zgrupa
                                    where (p.Id == id_material) && (p.AspNetUsersId == user.Value)
                                   select new
                                   {
                                       id = p.Id,
                                       name = p.name,
                                       description = p.description,
                                       idcategory=category.Id,
                                       Category = category.Category,
                                       weight = p.weight,
                                       expiry_date = p.expiry_date,
                                       type_spray = p.type_spray,
                                       application = p.application,
                                       unit_id=z.Id,
                                       unit_of_measure = z.unit_of_measure,
                                   }).ToListAsync();
            return Ok(zapytanie3);
        }


        // PUT api/Storehouse/(number)

        [HttpPut("mod_storehouse/{id_mod}")]
        public async Task<IActionResult> PutMaterial(int id_mod, MaterialDto materialDto)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            if (!MaterialExists(id_mod))
            {
                return NotFound();
            }
            else
            {
                var material_modified = await _context.Material.FindAsync(id_mod);
                if (material_modified.AspNetUsersId == userN.Value)
                {
                    material_modified.name = materialDto.name;
                    material_modified.description = materialDto.description;
                    material_modified.weight = materialDto.weight;
                    material_modified.expiry_date = materialDto.expiry_date;
                    material_modified.type_spray = materialDto.type_spray;
                    material_modified.application = materialDto.application;
                    material_modified.UnitId = materialDto.UnitId;
                    material_modified.CategoryStorehouseId = materialDto.CategoryStorehouseId;

                    await _context.SaveChangesAsync();
                    return Ok();
                }
            }
            return NoContent();
        }
        // POST api/Storehouse/add_material
        [HttpPost("add_material")]
        public async Task<ActionResult<Storehouse>> PostMaterial(Storehouse material)
        {
           
            var user = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            material.AspNetUsersId = user.Value;
            _context.Material.Add(material);
            await _context.SaveChangesAsync();

            return Ok("Sukces");
        }

        // DELETE api/Storehouse/(id_number)
        [HttpDelete("{id}")]
        public async Task<ActionResult<Storehouse>> DeleteMaterial(int id)
        {
            var user = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var material = await _context.Material.FindAsync(id);
            if (material == null)
            {
                return NotFound();
            }
            if (material.AspNetUsersId == user.Value)
            {
                _context.Material.Remove(material);
                await _context.SaveChangesAsync();
                return Ok("Sukces");
            }

            return NotFound();
        }

        private bool MaterialExists(int id)
        {
            return _context.Material.Any(e => e.Id == id);
        }
    }
}
