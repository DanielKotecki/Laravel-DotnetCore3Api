using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Models
{
    public class Animal
    {
        public int Id { get; set; }
        public string animal_id { get; set; }
        public string farm_id { get; set; }
        public string place_id { get; set; }
        public string old_farm_id { get; set; }
        public string old_place_id { get; set; }
        public string old_name { get; set; }
        public string old_surname { get; set; }
        public string sex { get; set; }
        public string breed { get; set; }
        public DateTime date_birth { get; set; }
        public string description { get; set; }
        public string number_mother { get; set; }
        public string number_father { get; set; }
        public DateTime? natural_death { get; set; }
        public DateTime? slaughter_date { get; set; }
        public DateTime date_marking { get; set; }
        public string AspNetUsersId { get; set; }
    }
}
