package geometria;

import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Circulo circulo = new Circulo(5);

        circulo.calcularArea();
        circulo.calcularPerimetro();

        System.out.println("Área circulo " + circulo.getArea());
        System.out.println("Perimetro circulo " + circulo.getPrimetro());

        Scanner scanner = new Scanner(System.in);
        double base, altura;
        System.out.print("Ingresa la base: ");
        base = scanner.nextDouble();


        System.out.print("Ingresa la altura: ");
        altura = scanner.nextDouble();

        Rectangulo rectangulo = new Rectangulo(base, altura);

        rectangulo.calcularArea();
        rectangulo.calcularPerimetro();

        System.out.print("Área rectangulo " + rectangulo.getArea());
        System.out.println("Perimetro rectangulo " + rectangulo.getPerimetro());


    }
}
