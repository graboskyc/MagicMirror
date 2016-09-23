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

    private final static int INTERVAL = 1000 * 60 * 15; 
    private String data = "<html>\n" +
            "\n" +
            "<head>\n" +
            "    <title>GSKY.us </title>\n" +
            "\n" +
            "</head><body style=\"margin:0;padding:0px;overflow:hidden;background-color:#000000;\">\n" +
            "<iframe src=\"http://grabosky.azurewebsites.net/globe\" id=\"mainframe\" style=\"overflow:hidden;height:100%;width:100%;\" width=\"100%\" height=\"100%\"></iframe> " +
            "</frame></html>";

    Handler mHandler = new Handler();
    AmazonWebView mWebView;

    Runnable mHandlerTask = new Runnable()
    {
        @Override
        public void run() {
            mWebView.loadData("", "text/html","UTF-8");
            mWebView.loadData(data, "text/html","UTF-8");
            mHandler.postDelayed(mHandlerTask, INTERVAL);
        }
    };

    void startRepeatingTask()
    {
        mHandlerTask.run();
    }

    void stopRepeatingTask()
    {
        mHandler.removeCallbacks(mHandlerTask);
    }

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



        mWebView = (AmazonWebView) findViewById(R.id.myWebView);
        factory.initializeWebView(mWebView, 0xFFFFFF, false, null);

        mWebView.getSettings().setJavaScriptEnabled(true);
        mWebView.loadData(data, "text/html","UTF-8");
        mHandlerTask.run();
    }

}
