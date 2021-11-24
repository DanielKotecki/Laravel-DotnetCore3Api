using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Models
{
    public class Storehouse
    {
        public int Id { get; set; }
        
        public string name { get; set; }
        public string description { get; set; }
        public int weight { get; set; }
        public DateTime? expiry_date { get; set; }
        public string type_spray { get; set; }
        public string application { get; set; }
        public int CategoryStorehouseId { get; set; }
        public int UnitId { get; set; }
        public string AspNetUsersId { get; set; }
    }
}
