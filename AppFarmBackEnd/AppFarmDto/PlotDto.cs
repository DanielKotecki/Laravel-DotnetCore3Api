using System;
using System.Collections.Generic;
using System.Text;

namespace AppFarmDto
{
   public class PlotDto
    {
        public int Id { get; set; }
        public string number_plot { get; set; }
        public string city { get; set; }
        public int area_hectare { get; set; }
        public bool rent { get; set; }
        public int Plot_typeId { get; set; }
        public string Plot_type_name { get; set; }
    }
}
