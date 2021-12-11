package profunda;

public class Calificacion implements Cloneable {
    private float chino;
    private float matematicas;
    private float ingles;

    public Calificacion(float chino, float matematicas, float ingles) {
        this.chino = chino;
        this.matematicas = matematicas;
        this.ingles = ingles;
    }

    @Override
    protected Object clone() throws CloneNotSupportedException {
        return super.clone();
    }

    public float getChino() {
        return chino;
    }

    public void setChino(float chino) {
        this.chino = chino;
    }

    public float getMatematicas() {
        return matematicas;
    }

    public void setMatematicas(float matematicas) {
        this.matematicas = matematicas;
    }

    public float getIngles() {
        return ingles;
    }

    public void setIngles(float ingles) {
        this.ingles = ingles;
    }

    @Override
    public String toString() {
        return "Calificacion{" +
                "chino=" + chino +
                ", matematicas=" + matematicas +
                ", ingles=" + ingles +
                '}';
    }
}
