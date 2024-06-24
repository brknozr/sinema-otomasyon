using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CinemaApplication.Siniflar
{
    public class FlimIslemleri
    {
        MySqlConnection con;
        MySqlDataAdapter data;
        public DataTable table;

        //flimler tablosu listeleme 
        public void VeriTransfer()
        {
            con = new MySqlConnection(Baglanti.baglan);
            con.Open();
            data = new MySqlDataAdapter("select * from filmler", con);
            table = new DataTable("datalar");
            data.Fill(table);
            con.Close();
        }

        //flim ekleme işlemi
        public void flimEkle(string adı,string tür,string süre,string görsel,int salonid,string açıklama,string fiyat)
        {
            con = new MySqlConnection(Baglanti.baglan);
            MySqlCommand sqlCommand = new MySqlCommand();
            sqlCommand.Connection = con;
            con.Open();
            sqlCommand.CommandText = "INSERT INTO filmler VALUES (NULL,'"+adı+ "','" + tür + "','" + süre + "','" + görsel + "','" + salonid + "','" + açıklama + "','" + fiyat + "')";
            sqlCommand.ExecuteNonQuery();
            con.Close();
        }

        //flim silme işlemi
        public void flimsil(int id)
        {
            con = new MySqlConnection(Baglanti.baglan);
            MySqlCommand sil = new MySqlCommand();
            sil.Connection = con;
            sil.CommandText = "delete from filmler where id=@no";
            int no = id;
            sil.Parameters.AddWithValue("@no", no);
            con.Open();
            sil.ExecuteNonQuery();
            con.Close();
        }

    }
}
