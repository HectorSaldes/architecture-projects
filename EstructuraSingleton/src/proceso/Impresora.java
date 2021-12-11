package proceso;

public class Impresora {
    private int numPaginas;
    private static Impresora impresora;

    private Impresora() {

    }

    public static Impresora getIntance() {
        return impresora = impresora == null ? new Impresora() : impresora;
    }

    public void imprimir(String texto) {
        System.out.println(texto);
        System.out.println("no. pág:" + (++numPaginas));
    }
}
