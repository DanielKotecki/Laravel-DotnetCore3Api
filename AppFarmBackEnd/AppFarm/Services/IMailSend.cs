using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Services
{
    public interface IMailSend
    {
        Task SendEmailAsync(string toEmail, string subject, string body);
    }
}
