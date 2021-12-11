package geometria;

public class Circulo implements FiguraGeometrica {

    private double radio;
    private double area;
    private double primetro;

    public Circulo(double radio) {
        this.radio = radio;
    }

    public Circulo(double radio, double area, double primetro) {
        this.radio = radio;
        this.area = area;
        this.primetro = primetro;
    }

    @Override
    public void calcularArea() {
        area = Math.PI * (radio * radio);
    }

    @Override
    public void calcularPerimetro() {
        primetro = 2 * Math.PI * radio;
    }

    public double getRadio() {
        return radio;
    }

    public void setRadio(double radio) {
        this.radio = radio;
    }

    public double getArea() {
        return area;
    }

    public void setArea(double area) {
        this.area = area;
    }

    public double getPrimetro() {
        return primetro;
    }

    public void setPrimetro(double primetro) {
        this.primetro = primetro;
    }
}
