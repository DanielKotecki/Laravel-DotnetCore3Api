using System;
using System.Collections.Generic;
using System.Text;

namespace AppFarmDto
{
    public class AlertWorkDto
    {
        public int Id { get; set; }
        public string numberPlot { get; set; }
        public string work_description { get; set; }
        public string alertMessage { get; set; }
        public DateTime dateEnd { get; set; }
        public string city { get; set; }
        public int plotId { get; set; }
        public int days_to_end { get; set; }
    }
}
