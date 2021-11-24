using System;
using System.Collections.Generic;
using System.Text;

namespace AppFarmDto
{
    public class ForgetResetPasswordDto
    {
        public string Email { get; set; }
        public string  NewPassword { get; set; }
        public string ConfirmNewPassword { get; set; }
        public string  Token { get; set; }
    }
}
