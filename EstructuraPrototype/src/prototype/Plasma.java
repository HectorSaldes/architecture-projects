package prototype;

public class Plasma extends TV {

    private double anguloVision;
    private double tiempoRespuesta;

    public Plasma(String marca, int pulgadas, String color, double precio, double anguloVision, double tiempoRespuesta) {
        super(marca, pulgadas, color, precio);
        setAnguloVision(anguloVision);
        setTiempoRespuesta(tiempoRespuesta);
    }


    public double getAnguloVision() {
        return anguloVision;
    }

    public void setAnguloVision(double anguloVision) {
        this.anguloVision = anguloVision;
    }

    public double getTiempoRespuesta() {
        return tiempoRespuesta;
    }

    public void setTiempoRespuesta(double tiempoRespuesta) {
        this.tiempoRespuesta = tiempoRespuesta;
    }

    @Override
    public String toString() {
        return "Plasma{" +
                "anguloVision=" + anguloVision +
                ", tiempoRespuesta=" + tiempoRespuesta +
                '}';
    }
}
