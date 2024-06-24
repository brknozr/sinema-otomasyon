using CinemaApplication.Siniflar;
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
    public partial class Rezervasyonlar : Form
    {
        public Rezervasyonlar()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form1 form1 = new Form1();
            form1.Show();
            this.Hide();
        }

        private void button9_Click(object sender, EventArgs e)
        {
            Anasayfa anasayfa = new Anasayfa();
            anasayfa.Show();
            this.Hide();
        }

        // rezervasyon listeleme işlemi
        private void Rezervasyonlar_Load(object sender, EventArgs e)
        {
            RezervasyonIslemleri rezervasyonlar = new RezervasyonIslemleri();
            rezervasyonlar.RezervasyonListesi();
            dataGridView2.DataSource = rezervasyonlar.table;
        }

        //rezervasyon iptal
        private void button3_Click(object sender, EventArgs e)
        {
            int numara;
            RezervasyonIslemleri rezervasyon = new RezervasyonIslemleri();
            numara = Convert.ToInt32(txt_biletkimlik.Text);
            try
            {
                rezervasyon.RezervasyonIptal(numara);
                MessageBox.Show("Rezervasyon İptali Başarılı", "Bilgilendirme", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
            catch (Exception ex)
            {
                MessageBox.Show("Rezervasyon İptal İşlemi Başarısız", "Uyarı" + ex.ToString());
            }
        }

        //çift tıklanınca bilet kimliği taşıma işlemi
        private void dataGridView2_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            int tıklanan = dataGridView2.SelectedCells[0].RowIndex;
            txt_biletkimlik.Text = dataGridView2.Rows[tıklanan].Cells[5].Value.ToString();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            {
                Rezervasyonlar rezervasyonlar  = new Rezervasyonlar ();
                rezervasyonlar.Show();
                this.Hide();
            }
        }

        private void dataGridView2_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void txt_biletkimlik_TextChanged(object sender, EventArgs e)
        {

        }
    }
}
