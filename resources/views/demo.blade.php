<div class="block-editor-block-list__layout is-root-container"><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-1f22e8af-604b-4ef9-96e0-4f440d770c90" data-block="1f22e8af-604b-4ef9-96e0-4f440d770c90" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">Hello Artisans, today I'll talk about Laravel Model observers. How observers work or how we can use? Laravel model observers are used to group event listeners for a model eloquent. Observer methods are fired when any type of event is dispatched through our eloquent model. The events are <span class="has-inline-color has-vivid-red-color">create()</span>, <span class="has-inline-color has-vivid-red-color">update()</span> or <span class="has-inline-color has-vivid-red-color">delete()</span>. The observer methods are </p><ul aria-label="Write list…" role="textbox" aria-multiline="true" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" id="block-eefa753c-17c8-43fd-9750-1d171ae8b72b" data-block="eefa753c-17c8-43fd-9750-1d171ae8b72b" data-type="core/list" data-title="List" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true"><li>Retrieved:&nbsp;After a record has been retrieved.</li><li>Creating:&nbsp;Before a record has been created.</li><li>Created:&nbsp;After a record has been created.</li><li>Updating:&nbsp;Before a record is updated.</li><li>Updated:&nbsp;After a record has been updated.</li><li>Saving:&nbsp;Before a record is saved (either created or updated).</li><li>Saved:&nbsp;After a record has been saved (either created or updated).</li><li>Deleting:&nbsp;Before a record is deleted or soft-deleted.</li><li>Deleted:&nbsp;After a record has been deleted or soft-deleted.</li><li>Restoring:&nbsp;Before a soft-deleted record is going to be restored.</li><li>Restored:&nbsp;After a soft-deleted record has been restored</li></ul><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-54f38edd-d9f6-404b-a7f1-dbb914bb3434" data-block="54f38edd-d9f6-404b-a7f1-dbb914bb3434" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">So, let's see an example of how observers works.</p><div aria-label="Block: Custom HTML" role="group" id="block-9a9e4666-ba4d-4454-a90e-a5841ae2dbbd" class="block-editor-block-list__block wp-block" data-block="9a9e4666-ba4d-4454-a90e-a5841ae2dbbd" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 39px;">&lt;h2 class="step"&gt;Example&lt;/h2&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-2f5f8d67-f1c1-4968-af64-550cb7f44f08" data-block="2f5f8d67-f1c1-4968-af64-550cb7f44f08" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">We'll see a simple example where by creating a post. Where in our posts table has a column of name,price,slug and unique_id. In the controller we'll save only the name of a posts. But our observer will help us to create the slug and unique_id of a post.</p><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-ae83f456-3136-4d0d-8203-16f895108744" data-block="ae83f456-3136-4d0d-8203-16f895108744" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true"><strong>Note:</strong>&nbsp;Tested on<strong>&nbsp;Laravel 9.2</strong>.</p><ol aria-label="Write list…" role="textbox" aria-multiline="true" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" id="block-6587a3c9-e497-4616-aa79-112db3f47b31" data-block="6587a3c9-e497-4616-aa79-112db3f47b31" data-type="core/list" data-title="List" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true"><li><a href="#step1">Setup Migration and Model</a> </li><li><a href="#step2">Create and Setup Observer</a></li><li><a href="#step3" data-rich-text-format-boundary="true">Create and Setup Controller</a></li><li><a href="#step4">Define Routes </a></li><li><a href="#step5">Output</a></li></ol><div aria-label="Block: Custom HTML" role="group" id="block-654fa681-7249-43e9-8188-aef7b14254d8" class="block-editor-block-list__block wp-block" data-block="654fa681-7249-43e9-8188-aef7b14254d8" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 39px;">&lt;h2 id="step1" class="step"&gt;Setup Migration and Model&lt;/h2&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-14f00827-24cc-4e06-9963-d639a0a87e12" data-block="14f00827-24cc-4e06-9963-d639a0a87e12" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">At first create a model and migration file using the below command</p><div aria-label="Block: Custom HTML" role="group" id="block-72cef509-8554-4d3f-a8c8-f0ad67a8328d" class="block-editor-block-list__block wp-block" data-block="72cef509-8554-4d3f-a8c8-f0ad67a8328d" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 39px;">&lt;pre&gt;&lt;code class="language-bash"&gt;php artisan make:model Post -m&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-8e656dbb-e0f1-44a8-a1f6-3dcb6aa6096f" data-block="8e656dbb-e0f1-44a8-a1f6-3dcb6aa6096f" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">It'll create a <strong>Post.php</strong> under <strong>app\Models</strong> and a <strong>posts</strong> migration file under <strong>database/migrations</strong>.</p><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-75f6534f-48f2-4c85-84ed-3d5c5fdd6dc8" data-block="75f6534f-48f2-4c85-84ed-3d5c5fdd6dc8" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">Now open the <strong>posts</strong> migration file put the below code</p><div aria-label="Block: Custom HTML" role="group" id="block-fefdb3a1-0bfb-485c-b1aa-44629c83577a" class="block-editor-block-list__block wp-block" data-block="fefdb3a1-0bfb-485c-b1aa-44629c83577a" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow-x: hidden; overflow-wrap: break-word; resize: none; height: 599px;">&lt;div class="filename"&gt;database/migrations/2022_04_29_120847_create_posts_table.php&lt;/div&gt;&lt;pre&gt;&lt;code class="language-php"&gt;&amp;lt;?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table-&amp;gt;id();
            $table-&amp;gt;string('name');
            $table-&amp;gt;string('slug');
            $table-&amp;gt;string('unique_id');
            $table-&amp;gt;timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-feac11f6-8954-4ff4-abf2-249ba657c1d7" data-block="feac11f6-8954-4ff4-abf2-249ba657c1d7" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">Now migrate the table using the below command.</p><div aria-label="Block: Custom HTML" role="group" id="block-9b0ccfe7-8b9f-4bd7-9b0e-49641b0ebe0f" class="block-editor-block-list__block wp-block" data-block="9b0ccfe7-8b9f-4bd7-9b0e-49641b0ebe0f" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 39px;">&lt;pre&gt;&lt;code class="language-bash"&gt;php artisan migrate&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-e1597e69-3452-4e61-801c-27ffa77012b5" data-block="e1597e69-3452-4e61-801c-27ffa77012b5" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">Now open the <strong>Post.php</strong> and and replace yours with the below code</p><div aria-label="Block: Custom HTML" role="group" id="block-44784dc1-bee5-4e5a-89b5-0a9dd6f3ad00" class="block-editor-block-list__block wp-block" data-block="44784dc1-bee5-4e5a-89b5-0a9dd6f3ad00" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 247px;">&lt;div class="filename"&gt;app/Models/Post.php&lt;/div&gt;&lt;pre&gt;&lt;code class="language-php"&gt;&amp;lt;?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','unique_id'];
}
&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><div aria-label="Block: Custom HTML" role="group" id="block-cb15635d-b3e5-4ead-a133-bdecec72e9b1" class="block-editor-block-list__block wp-block" data-block="cb15635d-b3e5-4ead-a133-bdecec72e9b1" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 39px;">&lt;h2 id="step2" class="step"&gt;Create and Setup Observer&lt;/h2&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-93edeb00-5ee0-4307-94cc-00bfb747137a" data-block="93edeb00-5ee0-4307-94cc-00bfb747137a" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">To create a observer, fire the below command in your terminal</p><div aria-label="Block: Custom HTML" role="group" id="block-ad0c1ef8-4eb0-424d-b4d1-1ac2e8237446" class="block-editor-block-list__block wp-block" data-block="ad0c1ef8-4eb0-424d-b4d1-1ac2e8237446" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 39px;">&lt;pre&gt;&lt;code class="language-bash"&gt;php artisan make:observer PostObserver --model=Post&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-49f2d922-6058-41fc-9504-9cfb37ca6eef" data-block="49f2d922-6058-41fc-9504-9cfb37ca6eef" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">It'll create a file called <strong>PostObserver.php</strong> under app/Observers. We'll use the <span class="has-inline-color has-vivid-red-color">creating()</span> and <span class="has-inline-color has-vivid-red-color">created()</span> method as of our example. So, put the below code in yours observer.</p><div aria-label="Block: Custom HTML" role="group" id="block-cdd0f70e-b149-4bbb-aca5-0a2024bc865a" class="block-editor-block-list__block wp-block" data-block="cdd0f70e-b149-4bbb-aca5-0a2024bc865a" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden scroll; overflow-wrap: break-word; resize: none; height: 679px;">&lt;div class="filename"&gt;app/Observers/PostObserver.php&lt;/div&gt;&lt;pre&gt;&lt;code class="language-php"&gt;&amp;lt;?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    public function creating(Post $post)
    {
        $post-&amp;gt;slug = Str::slug($post-&amp;gt;name);
    }

    public function created(Post $post)
    {
        $post-&amp;gt;unique_id = 'PR-'.$post-&amp;gt;id;
        $post-&amp;gt;save();
    }

    public function updated(Post $post)
    {
        //
    }

    public function deleted(Post $post)
    {
        //
    }

    public function restored(Post $post)
    {
        //
    }

    public function forceDeleted(Post $post)
    {
        //
    }
}
&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-5385cb92-8c56-4322-b9fe-e645e501c5cb" data-block="5385cb92-8c56-4322-b9fe-e645e501c5cb" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">Now we've to register the <strong>Observer</strong> in <strong>EventServiceProvider</strong> <span class="has-inline-color has-vivid-red-color">boot()</span> as below</p><div aria-label="Block: Custom HTML" role="group" id="block-45b99a4c-d3f3-4177-b50c-c4e64985316d" class="block-editor-block-list__block wp-block" data-block="45b99a4c-d3f3-4177-b50c-c4e64985316d" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden scroll; overflow-wrap: break-word; resize: none; height: 727px;">&lt;div class="filename"&gt;app/Providers/EventServiceProvider.php&lt;/div&gt;&lt;pre&gt;&lt;code class="language-php"&gt;&amp;lt;?php

namespace App\Providers;

use App\Models\Post;
use App\Observers\PostObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array&amp;lt;class-string, array&amp;lt;int, class-string&amp;gt;&amp;gt;
     */
    protected $listen = [
        Registered::class =&amp;gt; [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><div aria-label="Block: Custom HTML" role="group" id="block-7a801c85-9c89-4fde-96b1-f6347143f305" class="block-editor-block-list__block wp-block" data-block="7a801c85-9c89-4fde-96b1-f6347143f305" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 39px;">&lt;h2 id="step3" class="step"&gt;Create and Setup Controller&lt;/h2&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-fef288cd-aecb-472e-a112-48ae67c2fee1" data-block="fef288cd-aecb-472e-a112-48ae67c2fee1" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">Now we'll create a controller where we'll write our logic we'll save only <strong>name</strong> and <strong>price</strong> of a post and rest of the work done by observer that we'll register on <a href="#step2">#step2</a>. So, fire the below command in the terminal to create a controller.</p><div aria-label="Block: Custom HTML" role="group" id="block-11d3eda2-e8f3-4105-9cb7-2f14f33903ab" class="block-editor-block-list__block wp-block" data-block="11d3eda2-e8f3-4105-9cb7-2f14f33903ab" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 39px;">&lt;pre&gt;&lt;code class="language-bash"&gt;php artisan make:controller PostController&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-2323fa7a-ee69-4c6a-a054-63a2ff25d363" data-block="2323fa7a-ee69-4c6a-a054-63a2ff25d363" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">It'll create a controller under <strong>app\Http\Controller\PostController.php</strong>. Open the file and put the below codes.</p><div aria-label="Block: Custom HTML" role="group" id="block-c2c0773c-8d99-41c9-b2c8-185151568e12" class="block-editor-block-list__block wp-block" data-block="c2c0773c-8d99-41c9-b2c8-185151568e12" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden scroll; overflow-wrap: break-word; resize: none; height: 327px;">&lt;div class="filename"&gt;app/Http/Controllers/PostController.php&lt;/div&gt;&lt;pre&gt;&lt;code class="language-php"&gt;&amp;lt;?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store()
    {
        $post = Post::create([
            'name' =&amp;gt; 'Laravel Observer',
        ]);

        dd($post);
    }
}
&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><div aria-label="Block: Custom HTML" role="group" id="block-c6f75b20-b0a9-4d7d-93b0-65d52e14c50d" class="block-editor-block-list__block wp-block" data-block="c6f75b20-b0a9-4d7d-93b0-65d52e14c50d" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 39px;">&lt;h2 id="step4" class="step"&gt;Define Routes&lt;/h2&gt;</textarea></div></div><p aria-label="Paragraph block" role="textbox" class="block-editor-block-list__block rich-text block-editor-rich-text__editable wp-block" aria-multiline="true" id="block-a27afdeb-0d98-40a0-824f-d759c5d10862" data-block="a27afdeb-0d98-40a0-824f-d759c5d10862" data-type="core/paragraph" data-title="Paragraph" tabindex="0" style="white-space: pre-wrap; transform-origin: center center;" contenteditable="true">Put the below routes in your <strong>web.php</strong>.</p><div aria-label="Block: Custom HTML" role="group" id="block-764ff01f-dbb4-4cad-be92-2282b345184b" class="block-editor-block-list__block wp-block" data-block="764ff01f-dbb4-4cad-be92-2282b345184b" data-type="core/html" data-title="Custom HTML" tabindex="0" style="transform-origin: center center;"><div class="wp-block-html"><textarea class="block-editor-plain-text" placeholder="Write HTML…" aria-label="HTML" rows="1" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 55px;">&lt;div class="filename"&gt;routes/web.php&lt;/div&gt;&lt;pre&gt;&lt;code class="language-php"&gt;Route::get('post', [\App\Http\Controllers\PostController::class, 'store']);&lt;/code&gt;&lt;/pre&gt;</textarea></div></div><div tabindex="-1" class="block-list-appender"><div data-root-client-id="" class="wp-block block-editor-default-block-appender"><textarea role="button" aria-label="Add block" class="block-editor-default-block-appender__content" readonly="" rows="1" style="overflow: hidden; overflow-wrap: break-word; height: 20px;"></textarea><div class="components-dropdown block-editor-inserter"><button type="button" aria-haspopup="true" aria-expanded="false" class="components-button block-editor-inserter__toggle has-icon" aria-label="Add block"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false"><path d="M18 11.2h-5.2V6h-1.6v5.2H6v1.6h5.2V18h1.6v-5.2H18z"></path></svg></button></div></div></div></div>
