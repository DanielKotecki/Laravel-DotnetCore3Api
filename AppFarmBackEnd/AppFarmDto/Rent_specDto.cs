using System;
using System.Collections.Generic;
using System.Text;

namespace AppFarmDto
{
    public class Rent_specDto
    {
        public int Id { get; set; }
        public int PlotId { get; set; }
        public DateTime start_rent { get; set; }
        public DateTime end_date { get; set; }
        public float ground_rent_cost { get; set; }
        public int year_rent { get; set; }
        public int date_time_month { get; set; }
        public int date_time_days { get; set; }
    }
}
