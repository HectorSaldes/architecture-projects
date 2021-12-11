package profunda;

public class Estudiante implements Cloneable {
    private String nombre;
    private Calificacion calificacion;

    public Estudiante(String nombre, Calificacion calificacion) {
        this.nombre = nombre;
        this.calificacion = calificacion;
    }

    @Override
    protected Estudiante clone() throws CloneNotSupportedException {
//        return (Estudiante) super.clone();
        Estudiante estudiante = (Estudiante) super.clone();
        Calificacion calificacion = (Calificacion) estudiante.getCalificacion().clone();
        estudiante.setCalificacion(calificacion);
        return estudiante;

    }


    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public Calificacion getCalificacion() {
        return calificacion;
    }

    public void setCalificacion(Calificacion calificacion) {
        this.calificacion = calificacion;
    }

    @Override
    public String toString() {
        return "Estudiante{" +
                "nombre='" + nombre + '\'' +
                ", calificacion=" + calificacion +
                '}';
    }
}
