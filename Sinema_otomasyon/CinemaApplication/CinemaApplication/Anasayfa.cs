using CinemaApplication.Siniflar;
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
    public partial class Anasayfa : Form
    {
        public Anasayfa()
        {
            InitializeComponent();
        }

        // Flim silme işlemi 
        private void btn_sil_Click(object sender, EventArgs e)
        {
            FlimIslemleri flimSilme = new FlimIslemleri();
            int numara = Convert.ToInt32(txt_id.Text);
            try
            {
                flimSilme.flimsil(numara);
                MessageBox.Show("Flim Silme İşlemi Başarılı", "Bilgilendirme", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
            catch (Exception ex)
            {
                MessageBox.Show("Flim Silme İşlemi Başarısız", "Uyarı" + ex.ToString());
            }


        }

        //flim eke
        private void btn_ekle_Click(object sender, EventArgs e)
        {
            string adı, tür, süre, görsel, açıklama, fiyat;
            int salonid;

            FlimIslemleri flimIslemleri = new FlimIslemleri();
            adı = txt_flimad.Text;
            tür = txt_tür.Text;
            süre = txt_süre.Text;
            görsel = txt_görsel.Text;
            salonid = Convert.ToInt32(txt_salonno.Text);
            açıklama = txt_aciklama.Text;
            fiyat = txt_fiyat.Text;

            try
            {
                flimIslemleri.flimEkle(adı, tür, süre, görsel, salonid, açıklama, fiyat);
                MessageBox.Show("Flim Ekleme İşlemi Başarılı", "Bilgilendirme", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
            catch (Exception ex)
            {
                MessageBox.Show("Flim Ekleme İşlemi Başarısız", "Uyarı" + ex.ToString());
            }

        }

        //rezervasyon yapma işlemi
        private void button9_Click(object sender, EventArgs e)
        {
            Random rastgele = new Random();
            int sayi = rastgele.Next(10000, 15000);

            string seans_saati, bilet_kimlik, uye_id;
            int flim_id, koltukno;

            SatısIslemleri satis = new SatısIslemleri();
            flim_id = Convert.ToInt32(txt_id.Text);
            uye_id = txt_uyeid.Text;
            seans_saati = txt_saat.Text;
            bilet_kimlik = sayi.ToString();

            koltukno = Convert.ToInt32(txt_koltukno.Text);

            try
            {
                satis.biletSatis(flim_id, uye_id, seans_saati, koltukno, bilet_kimlik);
                MessageBox.Show("Bilet Satış İşlemi Başarılı", "Bilgilendirme", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
            catch (Exception ex)
            {
                MessageBox.Show("Bilet Satma İşlemi Başarısız", "Uyarı" + ex.ToString());
            }

        }

        // datagride 1 defa tıklayınca yapılacak işlemler
        private void dataGridView1_DoubleClick(object sender, EventArgs e)
        {
            int tıklanan = dataGridView1.SelectedCells[0].RowIndex;
            txt_id.Text = dataGridView1.Rows[tıklanan].Cells[0].Value.ToString();
            txt_flimad.Text = dataGridView1.Rows[tıklanan].Cells[1].Value.ToString();
            txt_tür.Text = dataGridView1.Rows[tıklanan].Cells[2].Value.ToString();
            txt_süre.Text = dataGridView1.Rows[tıklanan].Cells[3].Value.ToString();
            txt_görsel.Text = dataGridView1.Rows[tıklanan].Cells[4].Value.ToString();
            txt_salonno.Text = dataGridView1.Rows[tıklanan].Cells[5].Value.ToString();
            txt_aciklama.Text = dataGridView1.Rows[tıklanan].Cells[6].Value.ToString();
            txt_fiyat.Text = dataGridView1.Rows[tıklanan].Cells[7].Value.ToString();
            pictureBox1.ImageLocation = dataGridView1.Rows[tıklanan].Cells[4].Value.ToString();
        }

        // datagride 2 defa tıklayınca yapılacak işlemler
        private void dataGridView2_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            try
            {
                string connectionString = "Server=localhost;Database=sinema;Uid=root;Pwd='';";
                using (MySqlConnection cmd = new MySqlConnection(connectionString))
                {
                    string query = "SELECT * FROM rezervasyonlar WHERE film_id = @e1 AND seans_saati = @e2";
                    using (MySqlCommand command = new MySqlCommand(query, cmd))
                    {
                        command.Parameters.AddWithValue("@e1", txt_id.Text);
                        command.Parameters.AddWithValue("@e2", txt_saat.Text);

                        cmd.Open();

                        using (MySqlDataReader reader = command.ExecuteReader())
                        {
                            // Sorgudan dönen her bir satır için, rezervasyon koltuklarını bir diziye dönüştür
                            List<string> reservedSeats = new List<string>();
                            while (reader.Read())
                            {
                                reservedSeats.Add(reader["koltuk_no"].ToString());
                            }

                            // tıklanan değeri txt_koltuğa atama işlemi
                            int tıklanan = dataGridView2.SelectedCells[0].RowIndex;
                            txt_koltuk.Text = dataGridView2.Rows[tıklanan].Cells[3].Value.ToString();
                            int sayi = Convert.ToInt32(txt_koltuk.Text);

                            int buttonCount = sayi; // Oluşturulacak düğme sayısı
                            int buttonWidth = 45; // Düğmelerin genişliği
                            int buttonHeight = 30; // Düğmelerin yüksekliği
                            int spacing = 3; // Düğmeler arasındaki boşluk
                            int startX = 380; // Başlangıç X pozisyonu
                            int startY = 110; // Başlangıç Y pozisyonu
                            int rowCount = 5; // Düğmelerin dikeydeki sıra sayısı
                            int columnCount = 10; // Düğmelerin yataydaki sütun sayısı
                            int textCounter = 1; // Metin değeri sayacı

                            for (int i = 0; i < buttonCount; i++)
                            {
                                Button button = new Button();
                                button.Text = textCounter.ToString(); // Metin değeri ayarı

                                // Rezervasyon koltukları dizisindeki herhangi bir elemana eşleşme varsa, butonun rengini kırmızı yap
                                if (reservedSeats.Contains(button.Text))
                                {
                                    button.BackColor = Color.Red;
                                }
                                else
                                {
                                    button.BackColor = Color.Green;
                                }

                                textCounter++; // Metin değeri sayacını arttırma

                                button.Size = new System.Drawing.Size(buttonWidth, buttonHeight);

                                // Düğmeleri yatay ve dikey olarak sıralama
                                int row = i / columnCount;
                                int column = i % columnCount;
                                button.Location = new System.Drawing.Point(startX + (buttonWidth + spacing) * column, startY + (buttonHeight + spacing) * row);

                                // Buton tıklama olayını ayarla
                                button.Click += (sende, args) =>
                                {
                                    Button clickedButton = sende as Button;
                                    txt_koltukno.Text = clickedButton.Text;
                                };

                                this.Controls.Add(button);
                            }
                        }
                        cmd.Close();
                    }
                }
            }
            catch (Exception)
            {
                MessageBox.Show("Hatalı İşlem Girişi Tekrar Deneyiniz");
            }
        }

        //rezervasyonlara yönlendirme 
        private void button10_Click(object sender, EventArgs e)
        {
            Rezervasyonlar rezervasyonlar = new Rezervasyonlar();
            rezervasyonlar.Show();
            this.Hide();
        }

        //form açılınca
        private void Anasayfa_Load(object sender, EventArgs e)
        {
            FlimIslemleri veri = new FlimIslemleri();
            veri.VeriTransfer();
            dataGridView1.DataSource = veri.table;


            SalonIslemleri veri1 = new SalonIslemleri();
            veri1.VeriTransfer1();
            dataGridView2.DataSource = veri1.table;
        }

        //Anasyfaya yönlendirme
        private void button2_Click(object sender, EventArgs e)
        {
            Anasayfa anasayfa = new Anasayfa();
            anasayfa.Show();
            this.Hide();
        }

        private void checkBox1_CheckedChanged(object sender, EventArgs e)
        {
            txt_saat.Text = checkBox1.Checked ? "11:00" : ""; ;
        }

        private void checkBox2_CheckedChanged(object sender, EventArgs e)
        {
            txt_saat.Text = checkBox2.Checked ? "18:00" : ""; ;
        }

        private void checkBox4_CheckedChanged(object sender, EventArgs e)
        {
            txt_saat.Text = checkBox4.Checked ? "20:00" : ""; ;
        }

        private void checkBox3_CheckedChanged(object sender, EventArgs e)
        {
            txt_saat.Text = checkBox3.Checked ? "23:00" : ""; ;
        }

        private void dataGridView2_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }
    }
}
