using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Models
{
    public class User_spec
    {
        public int Id { get; set; }
        public string  name { get; set; }
        public string  surname { get; set; }
        public string city { get; set; }
        public string address { get; set; }
        public string country { get; set; }
        public string AspNetUsersId { get; set; }
    }
}

