using AppFarm.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace AppFarm.Seeder
{
    public class AddDataDb
    {
        AppDbContext _appDbContext;
        public AddDataDb(AppDbContext appDbContext)
        {
            _appDbContext = appDbContext;

        }
        public void Seed()
        {
            if (_appDbContext.Database.CanConnect())
            {
                if ((!_appDbContext.CategoryMachines.Any())&&(!_appDbContext.Units.Any())&&(!_appDbContext.CategoryStorehouses.Any())&&(!_appDbContext.plot_Types.Any()))
                {
                    InsertCategoryMachine();
                    InsertUnit();
                    InsertCategoryStorehouse();
                    InsertPlot_types();
                    
                }
              
            }
        }

        private  void InsertPlot_types()
        {
            var plot_type = new List<Plot_type>
           {
               new Plot_type
               {
                   type_p="Leśna"
               },
               new Plot_type
               {
                   type_p="Rekreacyjna"
               },
               new Plot_type
               {
                   type_p="Budowlana"
               },
               new Plot_type
               {
                   type_p="Rolna"
               },
               new Plot_type
               {
                   type_p="Inwestycyjna"
               },
               new Plot_type
               {
                   type_p="Siedliskowa"
               },
           };
             _appDbContext.AddRange(plot_type);
             _appDbContext.SaveChanges();
        }

        private void InsertCategoryStorehouse()
        {
            var category = new List<CategoryStorehouse>
            {
            new CategoryStorehouse
            {
                Category="Zboża"
            },
               new CategoryStorehouse
            {
                Category="Nawóz nieorganiczny"
            },
                  new CategoryStorehouse
            {
                Category="Nawóz organiczny"
            },
                     new CategoryStorehouse
            {
                Category="Oprysk"
            },
                        new CategoryStorehouse
            {
                Category="Paliwo"
            },
                           new CategoryStorehouse
            {
                Category="Narzędzia"
            },
                              new CategoryStorehouse
            {
                Category="Balot"
            },
                                 new CategoryStorehouse
            {
                Category="Pasza objętościowa"
            },
                                    new CategoryStorehouse
            {
                Category="Owoce"
            },
                                       new CategoryStorehouse
            {
                Category="Warzywo"
            },
                                          new CategoryStorehouse
            {
                Category="Rośliny strączkowe"
            },
                                             new CategoryStorehouse
            {
                Category="Rośliny okopowe"
            },
                                                new CategoryStorehouse
            {
                Category="Rośliny pastewne"

            },
                                                   new CategoryStorehouse
            {
                Category="Inne"
            }
            };
            _appDbContext.AddRange(category);
             _appDbContext.SaveChanges();
        }

        private  void InsertUnit()
        {
            var unit = new List<Unit> 
            {
               new Unit
               {
                   unit_of_measure="kg"
               },
               new Unit
               {
                   unit_of_measure="l"
               },  
               new Unit
               {
                   unit_of_measure="t"
               },  
               new Unit
               { 
                   unit_of_measure = "ml"
               },  
               new Unit
               {
                   unit_of_measure = "g"
               },  
               new Unit
               {
                   unit_of_measure = "szt."
               }
              
            }; 
             _appDbContext.AddRange(unit);
             _appDbContext.SaveChanges();
        }

        private  void InsertCategoryMachine()
        {
            var category = new List<CategoryMachine> {
                new CategoryMachine
                {
                    name_category_machine="Ciągnik"
                },
                     new CategoryMachine
                {
                    name_category_machine="Kombajn ogólny"
                },
                        new CategoryMachine
                {
                    name_category_machine="Kombajn trzcinowy"
                },
                           new CategoryMachine
                {
                    name_category_machine="Ładowarka"
                },
                              new CategoryMachine
                {
                    name_category_machine="Kombajn do ziemniaków"
                },
                                 new CategoryMachine
                {
                    name_category_machine="Przyczepa"
                },
                                    new CategoryMachine
                {
                    name_category_machine="Transport zwierząt"
                },
                                       new CategoryMachine
                {
                    name_category_machine="Pług"
                },
                                          new CategoryMachine
                {
                    name_category_machine="Brona"
                },
                                             new CategoryMachine
                {
                    name_category_machine="Sadzarka"
                },
                                                new CategoryMachine
                {
                    name_category_machine="Rozrzutnik obrnika"
                },
                                                   new CategoryMachine
                {
                    name_category_machine="Siwnik"
                },
                                                      new CategoryMachine
                {
                    name_category_machine="Kultywator"
                },
                                                         new CategoryMachine
                {
                    name_category_machine="Technologia nawożenia"
                },
                                                            new CategoryMachine
                {
                    name_category_machine="Chwastownik"
                },
                                                               new CategoryMachine
                {
                    name_category_machine="Kosiarka"
                },
                                                                  new CategoryMachine
                {
                    name_category_machine="Technologia Bel"
                },
                                                                     new CategoryMachine
                {
                    name_category_machine="Ochrona roślin"
                }
            };
             _appDbContext.AddRange(category);
             _appDbContext.SaveChanges();
        }
    }
}
