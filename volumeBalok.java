import java.util.Scanner;
/**
 * program untuk menghitung volume balok
 *
 * @author Sofi
 */
public class volumeBalok {
    /**
     * method ini untuk menghitung volume balok dan mengoutputkan nilai panjang lebar tinggi dan volumenya
     *
     * @param p untuk menyimpan nilai panjang
     * @param l untuk menyimpan nilai lebar
     * @param t untuk menyimpan nilai tinggi
     */
    public void hitungRumus(double p, double l, double t){
        double volume = p*l*t;
        System.out.println("volume balok dengan panjang "+p+", lebar "+l+", tinggi "+t+" adalah "+volume);
    }

    /**
     * untuk menginputkan panjang lebar dan tinggi
     * @param args argumen baris perintah
     */
    public static void main(String[] args) {
        volumeBalok obj = new volumeBalok();
        Scanner sc = new Scanner(System.in);
        System.out.println("masukkan panjang: ");
        double panjang = sc.nextDouble();
        System.out.println("masukkan lebar: ");
        double lebar = sc.nextDouble();
        System.out.println("masukkan tinggi: ");
        double tinggi = sc.nextDouble();
        obj.hitungRumus(panjang,lebar,tinggi);
    }
}