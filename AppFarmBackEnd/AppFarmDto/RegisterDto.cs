using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Text;

namespace AppFarmDto
{
    public class RegisterDto
    {
        [Required]
        [EmailAddress]
        public string Email { get; set; }
        [Required]
        [StringLength(40, MinimumLength = 5)]
        public string Password { get; set; }
        [Required]
        [StringLength(40, MinimumLength = 6)]
        public string ConfirmPassword { get; set; }
    }
}
