package superficial;

public class MainClonacion {
//    Se genera una copia del objeto generando una nueva referencia
    public static void main(String[] args) throws CloneNotSupportedException {
        Persona objOriginal = new Persona("Hector", 20);
        Persona objClonado = objOriginal.clone();
        objOriginal.setNombre("Juan");
        objOriginal.setEdad(22);

        System.out.println(objOriginal);
        System.out.println(objClonado);
    }
}
