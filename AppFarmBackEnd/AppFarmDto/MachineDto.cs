using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Text;

namespace AppFarmDto
{
   public class MachineDto
    {
        public string machine_id { get; set; }
        public string mark { get; set; }
        public string model { get; set; }
        public string year { get; set; }
        public int power { get; set; }
        public int power_need { get; set; }
        public float working_width { get; set; }
        public int capacity { get; set; }
        [DisplayFormat(DataFormatString = "{0:yyyy/mm/dd}")]
        public DateTime? insurance_date { get; set; }
        [DisplayFormat(DataFormatString = "{0:yyyy/mm/dd}")]
        public DateTime? mot_check { get; set; }
        public bool attached { get; set; }
        public int CategoryMachineId { get; set; }
        
    }
}
