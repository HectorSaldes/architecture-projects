import app.Application;
import factories.GUIFactory;
import factories.MacOSFactory;
import factories.WindowsFactory;

public class Main {

    private static Application configureApplication() {
        Application app;
        GUIFactory factory;
        String nombreOS = System.getProperty("os.name").toUpperCase();
        if (nombreOS.contains("mac")) {
            factory = new MacOSFactory();
        } else {
            factory = new WindowsFactory();
        }
        app = new Application(factory);
        return app;
    }


    public static void main(String[] args) {
        Application app = configureApplication();
        app.paint();
    }
}
