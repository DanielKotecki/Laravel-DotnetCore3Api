using Microsoft.Extensions.Configuration;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Mail;
using System.Threading.Tasks;

namespace AppFarm.Services
{
    public class MailSend : IMailSend
    {
        IConfiguration _configuration;
        public MailSend(IConfiguration configuration)
        {
            _configuration = configuration;
        }
        public async Task SendEmailAsync(string toEmail, string subject, string body)
        {
            
            var fromAddress = new MailAddress(_configuration["EmailConfig:Email"]);
            var toAddress = new MailAddress(toEmail);
            string fromPassword = _configuration["EmailConfig:Password_Email"];

            var smtp = new SmtpClient
            {
                Host = _configuration["SmtpConfig:Host"],
                Port = int.Parse(_configuration["SmtpConfig:Port"]),
                EnableSsl = true,
                DeliveryMethod = SmtpDeliveryMethod.Network,
                UseDefaultCredentials = false,
                Credentials = new NetworkCredential(fromAddress.Address,fromPassword)
            };
            using (var message = new MailMessage(fromAddress, toAddress)
            {
                
                Subject = subject,
                Body = body
               
            })
            {
                smtp.EnableSsl = true;
                message.IsBodyHtml = true;
                await smtp.SendMailAsync(message);

            }

        }
    }
}
