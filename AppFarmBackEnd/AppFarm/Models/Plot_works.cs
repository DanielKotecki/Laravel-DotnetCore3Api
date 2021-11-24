using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Models
{
    public class Plot_works
    {
        public int Id { get; set; }
        public int PlotId { get; set; }
        public string work_description { get; set; }
        public DateTime start_working { get; set; }
        public DateTime end_working { get; set; }
        public string status { get; set; }
        public string AspNetUsersId { get; set; }
    }
}
