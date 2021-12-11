package prototype;

public class Principal {

    public static void main(String[] args) throws CloneNotSupportedException {
        TVPrototype tvPrototype = new TVPrototype();
        Plasma plasma = (Plasma) tvPrototype.prototipo("plasma");
        LCD lcd = (LCD) tvPrototype.prototipo("lcd");
        System.out.println(plasma.toString());
        System.out.println(lcd.toString());
    }

}
