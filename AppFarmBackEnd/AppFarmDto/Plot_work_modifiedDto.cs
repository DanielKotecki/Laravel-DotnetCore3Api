using System;
using System.Collections.Generic;
using System.Text;

namespace AppFarmDto
{
   public class Plot_work_modifiedDto
    {
        public int PlotId { get; set; }
        public string work_description { get; set; }
        public DateTime start_working { get; set; }
        public DateTime end_working { get; set; }
        public string status { get; set; }
        
    }
}
