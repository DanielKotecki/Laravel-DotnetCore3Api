using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Identity.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Models
{
  
    public class AppDbContext : IdentityDbContext
    {

        public AppDbContext(DbContextOptions<AppDbContext> options) : base(options) { }

      


        public DbSet<Animal> Animals { get; set; }
        public DbSet<CategoryMachine> CategoryMachines { get; set; }

        public DbSet<CategoryStorehouse> CategoryStorehouses { get; set; }

        public DbSet<Machine> Machines { get; set; }
        public DbSet<Plot> Plots { get; set; }
        public DbSet<Plot_type> plot_Types{ get; set; }
        public DbSet<Plot_works>plot_Works { get; set; }
        public DbSet<Rent_spec>rent_Specs { get; set; }
        public DbSet<Storehouse> Material{ get; set; }
        public DbSet<Unit> Units{ get; set; }
        public DbSet<User_spec> user_Specs{ get; set; }
       
    }
}
