package profunda;

public class MainClonacion {
//    No cambia la referencia, todos los objetos son afectados si se cambia
    public static void main(String[] args) throws CloneNotSupportedException {
        Calificacion calificacion = new Calificacion(100, 100, 100);
        Estudiante estudiante = new Estudiante("Hector", calificacion);
        System.out.println(estudiante);

        Estudiante estudianteClonado = estudiante.clone();

        estudiante.setNombre("Francisco");
        estudiante.getCalificacion().setChino(90);
        estudiante.getCalificacion().setIngles(90);
        estudiante.getCalificacion().setMatematicas(90);


        System.out.println(estudiante);
        System.out.println(estudianteClonado);
    }
}
