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
using AppFarmDto;

namespace AppFarm.Controllers
{
    [Authorize(AuthenticationSchemes = "Bearer")]
    [Route("api/[controller]")]
    [ApiController]
    public class AnimalsController : ControllerBase
    {
        private readonly AppDbContext _context;

        public AnimalsController(AppDbContext context)
        {
            _context = context;
        }
        ///Ilość zwierzaków

        [HttpGet("count_animal")]
        public async Task<IActionResult> GetCountAnimal()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            return Ok(await _context.Animals.Where(x => x.AspNetUsersId == userN.Value).CountAsync());

        }



        // GET: api/Animals
        [HttpGet("All_animals")]
        public async Task<ActionResult<IEnumerable<AnimalDto>>> GetAnimals()
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            return await _context.Animals.Where(x => x.AspNetUsersId == userN.Value).Select(x => new AnimalDto() {
                id = x.Id,
                animal_id=x.animal_id,
                farm_id = x.farm_id,
                place_id = x.place_id,
                old_farm_id = x.old_farm_id,
                old_place_id = x.old_place_id,
                old_name = x.old_name,
                old_surname = x.old_surname,
                sex = x.sex,
                breed = x.breed,
                date_birth = x.date_birth,
                description = x.description,
                number_mother = x.number_mother,
                number_father = x.number_father,
                natural_death = x.natural_death,
                slaughter_date = x.slaughter_date,
                date_marking = x.date_marking,
                time_liveYear = DateTime.Now.Year - x.date_birth.Year,
                time_liveDays=DateTime.Now.Day-x.date_birth.Day

            }).ToListAsync();
        }

        // GET: api/Animals/5
        [HttpGet("oneAnimal/{id}")]
        public async Task<ActionResult<AnimalDto>> GetAnimal(int id)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);

            try
            {
                var animal = await _context.Animals.Where(x => x.AspNetUsersId == userN.Value).Where(x => x.Id == id).Select(x => new AnimalDto()
                {
                    id=x.Id,
                    animal_id=x.animal_id,
                    farm_id = x.farm_id,
                    place_id=x.place_id,
                    old_farm_id=x.old_farm_id,
                    old_place_id=x.old_place_id,
                    old_name=x.old_name,
                    old_surname=x.old_surname,
                    sex=x.sex,
                    breed=x.breed,
                    date_birth=x.date_birth,
                    description=x.description,
                    number_mother=x.number_mother,
                    number_father=x.number_father,
                    natural_death=x.natural_death,
                    slaughter_date=x.slaughter_date,
                    date_marking=x.date_marking

                }).ToListAsync();
                return Ok(animal);
            }
            catch (Exception e)
            {
                if (!AnimalExists(id))
                {
                    return NotFound();
                }
                else
                { 
                    throw e;
                }
            }
         
        }

        // PUT: api/Animals/5
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAnimal(int id, AnimalDto animalDto)
        {
            Claim userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            try
            {
                var animal_modified = await _context.Animals.FindAsync(id);
                if (animal_modified.AspNetUsersId==userN.Value)
                {
                    animal_modified.animal_id = animalDto.animal_id;
                    animal_modified.farm_id = animalDto.farm_id;
                    animal_modified.place_id = animalDto.place_id;
                    animal_modified.old_farm_id = animalDto.old_farm_id;
                    animal_modified.old_place_id = animalDto.old_place_id;
                    animal_modified.old_name = animalDto.old_name;
                    animal_modified.old_surname = animalDto.old_surname;
                    animal_modified.sex = animalDto.sex;
                    animal_modified.breed = animalDto.breed;
                    animal_modified.date_birth = animalDto.date_birth;
                    animal_modified.description = animalDto.description;
                    animal_modified.number_mother = animalDto.number_mother;
                    animal_modified.number_father = animalDto.number_father;
                    animal_modified.natural_death = animalDto.natural_death;
                    animal_modified.slaughter_date = animalDto.slaughter_date;
                    _context.Animals.Update(animal_modified);
                    await _context.SaveChangesAsync();
                    return Ok("Sukces");
                }               
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!AnimalExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }
            return NoContent();
        }

        // POST: api/Animals
        // To protect from overposting attacks, enable the specific properties you want to bind to, for
        // more details, see https://go.microsoft.com/fwlink/?linkid=2123754.
        [HttpPost("Add_Animal")]
        public async Task<ActionResult<Animal>> PostAnimal(Animal animal)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            animal.AspNetUsersId = userN.Value;
            _context.Animals.Add(animal);
            await _context.SaveChangesAsync();

            return Ok(animal);
        }

        // DELETE: api/Animals/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<Animal>> DeleteAnimal(int id)
        {
            var userN = HttpContext.User.FindFirst(x => x.Type == ClaimTypes.NameIdentifier);
            var animal = await _context.Animals.FindAsync(id);
            if (animal == null)
            {
                return NotFound();
            }
            else if (animal.AspNetUsersId==userN.Value)
            {
                _context.Animals.Remove(animal);
                await _context.SaveChangesAsync();
                return Ok();
            }
            return NoContent();
        }

        private bool AnimalExists(int id)
        {
            return _context.Animals.Any(e => e.Id == id);
        }
    }
}
