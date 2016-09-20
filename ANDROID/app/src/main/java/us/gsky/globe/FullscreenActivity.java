package us.gsky.globe;

import android.annotation.SuppressLint;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.os.Handler;
import android.view.MotionEvent;
import android.view.View;
import android.view.WindowManager;
import com.amazon.android.webkit.AmazonWebKitFactories;
import com.amazon.android.webkit.AmazonWebKitFactory;
import com.amazon.android.webkit.AmazonWebView;

/**
 * An example full-screen activity that shows and hides the system UI (i.e.
 * status bar and navigation/system bar) with user interaction.
 */
public class FullscreenActivity extends AppCompatActivity {
    private static boolean sFactoryInit = false;
    private AmazonWebKitFactory factory = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        getWindow().addFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON);
        setContentView(R.layout.activity_fullscreen);
        if (!sFactoryInit) {
            factory = AmazonWebKitFactories.getDefaultFactory();
            if (factory.isRenderProcess(this)) {
                return; // Do nothing if this is on render process
            }
            factory.initialize(this.getApplicationContext());

// factory configuration is done here, for example:
            factory.getCookieManager().setAcceptCookie(true);

            sFactoryInit = true;
        } else {
            factory = AmazonWebKitFactories.getDefaultFactory();
        }

        AmazonWebView mWebView;

        mWebView = (AmazonWebView) findViewById(R.id.myWebView);
        factory.initializeWebView(mWebView, 0xFFFFFF, false, null);

        mWebView.getSettings().setJavaScriptEnabled(true);
        String data = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\"\n" +
                "        \"http://www.w3.org/TR/html4/strict.dtd\">\n" +
                "<html>\n" +
                "\n" +
                "<head>\n" +
                "    <title>GSKY.us </title>\n" +
                "\n" +
                "</head>\n" +
                "<frameset rows=\"100%,*\" border=\"0\">\n" +
                "    <frame src=\"http://grabosky.azurewebsites.net/globe\" frameborder=\"0\" />\n" +
                "    <frame frameborder=\"0\" noresize />\n" +
                "</frameset>\n" +
                "</html>";
        //mWebView.loadUrl("http://grabosky.azurewebsites.net/globe");
        mWebView.loadData(data, "text/html","UTF-8");
    }

}
