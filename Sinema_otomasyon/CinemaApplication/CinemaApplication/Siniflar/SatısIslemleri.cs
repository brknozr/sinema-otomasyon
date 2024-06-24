using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CinemaApplication.Siniflar
{
    public class SatısIslemleri
    {
        MySqlConnection con;
        public DataTable table;

        
        public void biletSatis(int flim_id, string uye_id, string seans_saati, int koltukno, string bilet_kimlik)
        {
            con = new MySqlConnection(Baglanti.baglan);
            MySqlCommand sqlCommand = new MySqlCommand();
            sqlCommand.Connection = con;
            con.Open();
            sqlCommand.CommandText = "INSERT INTO rezervasyonlar VALUES (NULL,'" + flim_id + "','" + uye_id + "','" + seans_saati + "','" + koltukno + "','" + bilet_kimlik + "')";
            sqlCommand.ExecuteNonQuery();
            con.Close();
        }
    }
}
