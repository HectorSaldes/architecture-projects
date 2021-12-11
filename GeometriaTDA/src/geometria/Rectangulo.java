package geometria;

public class Rectangulo implements FiguraGeometrica {

    private double area;
    private double perimetro;
    private double base;
    private double altura;

    public Rectangulo(double base, double altura) {
        this.base = base;
        this.altura = altura;
    }

    public Rectangulo(double area, double perimetro, double base, double altura) {
        this.area = area;
        this.perimetro = perimetro;
        this.base = base;
        this.altura = altura;
    }

    @Override
    public void calcularArea() {
        area = base * altura;
    }

    @Override
    public void calcularPerimetro() {
        perimetro = base * 2 + altura * 2;
    }


    public double getArea() {
        return area;
    }

    public void setArea(double area) {
        this.area = area;
    }

    public double getPerimetro() {
        return perimetro;
    }

    public void setPerimetro(double perimetro) {
        this.perimetro = perimetro;
    }

    public double getBase() {
        return base;
    }

    public void setBase(double base) {
        this.base = base;
    }

    public double getAltura() {
        return altura;
    }

    public void setAltura(double altura) {
        this.altura = altura;
    }
}
