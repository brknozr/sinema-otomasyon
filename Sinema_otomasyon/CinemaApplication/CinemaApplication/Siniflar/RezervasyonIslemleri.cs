using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CinemaApplication.Siniflar
{
    public class RezervasyonIslemleri
    {
        MySqlConnection con;
        MySqlDataAdapter data;
        public DataTable table;

        //Salonlar tablosu listeleme 
        public void RezervasyonListesi()
        {
            con = new MySqlConnection(Baglanti.baglan);
            con.Open();
            data = new MySqlDataAdapter("select * from rezervasyonlar", con);
            table = new DataTable("datalar");
            data.Fill(table);
            con.Close();
        }

        //rezervasyon iptali
        public void RezervasyonIptal(int biletno)
        {
            con = new MySqlConnection(Baglanti.baglan);
            MySqlCommand sil = new MySqlCommand();
            sil.Connection = con;
            sil.CommandText = "delete from rezervasyonlar where bilet_kimlik=@no";
            int no = biletno;
            sil.Parameters.AddWithValue("@no", no);
            con.Open();
            sil.ExecuteNonQuery();
            con.Close();
        }
    }
}
