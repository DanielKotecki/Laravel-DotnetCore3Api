using System;
using System.Collections.Generic;
using System.Text;

namespace AppFarmDto
{
  public class AlertDto
    {
        public int Id { get; set; }
        public string machine_id { get; set; }
        public string mark { get; set; }
        public string model { get; set; }
        public DateTime date { get; set; }
        public string alertMessage { get; set; }
    }
}
