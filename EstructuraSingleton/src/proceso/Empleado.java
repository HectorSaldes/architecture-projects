package proceso;

public class Empleado {
    private final String nombre;
    private final String puesto;

    public Empleado(String nombre, String puesto){
        this.nombre = nombre;
        this.puesto = puesto;
    }

    public void imprimir(){
        Impresora impresora = Impresora.getIntance();
        impresora.imprimir("Nombre:"+nombre+"\nPuesto:"+puesto);
    }
}
