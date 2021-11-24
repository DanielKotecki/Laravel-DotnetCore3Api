using System;
using System.Collections.Generic;
using System.Text;

namespace AppFarmDto
{
   public class DeleteUserDto
    {
        public string  IdUser { get; set; }
        public string Password { get; set; }
        public string ConfirmPassword { get; set; }
    }
}
