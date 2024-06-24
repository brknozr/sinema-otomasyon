using CinemaApplication.Siniflar;
using LinqToDB.Data;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace CinemaApplication
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void btn_giris_Click(object sender, EventArgs e)
        {
            MySqlConnection con;
            con = new MySqlConnection(Baglanti.baglan);
            con.Open();
            MySqlCommand islem = new MySqlCommand("select * from uyeler where uye_adi=@e1 and uye_soyadi=@e2 and uye_sifre=@e3")
            {
                Connection = con
            };

            islem.Parameters.AddWithValue("@e1", txt_ad.Text);
            islem.Parameters.AddWithValue("@e2", txt_soyad.Text);
            islem.Parameters.AddWithValue("@e3", txt_sifre.Text);

            MySqlDataReader dataReader = islem.ExecuteReader();

            if (dataReader.Read())
            {
                Anasayfa anasyfa = new Anasayfa();
                anasyfa.Show();
                this.Hide();
            }
            else
            {
                MessageBox.Show("Hatalı Giriş Değerleri Kontrol Ediniz", "Hata", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            con.Close();
           
        }

        //txt çifreye girilen değeri şifre formatına çevirme
        private void Form1_Load(object sender, EventArgs e)
        {
            txt_sifre.PasswordChar = '*';
        }
    }
}
