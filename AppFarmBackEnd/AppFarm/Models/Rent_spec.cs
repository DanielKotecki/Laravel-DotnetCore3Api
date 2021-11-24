using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Models
{
    public class Rent_spec
    {
        public int Id { get; set; }
        public int PlotId { get; set; }
        public DateTime start_rent { get; set; }
        public DateTime end_date { get; set; }
        public float ground_rent_cost { get; set; }
        public string AspNetUsersId { get; set; }

    }
}
