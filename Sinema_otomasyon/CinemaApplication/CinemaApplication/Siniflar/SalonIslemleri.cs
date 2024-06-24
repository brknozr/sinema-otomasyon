using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CinemaApplication.Siniflar
{
    public class SalonIslemleri
    {
        MySqlConnection con;
        MySqlDataAdapter data;
        public DataTable table;

        //Salonlar tablosu listeleme 
        public void VeriTransfer1()
        {
            con = new MySqlConnection(Baglanti.baglan);
            con.Open();
            data = new MySqlDataAdapter("select * from salon", con);
            table = new DataTable("datalar");
            data.Fill(table);
            con.Close();
        }

    }
}
