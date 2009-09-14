<?php 
use_Helper('Javascript');
echo javascript_tag("function toggleMarkdownHelp()
{
  ( document.getElementById('markdown_help').style.display == 'none' ) ? document.getElementById('markdown_help').style.display = 'block' : document.getElementById('markdown_help').style.display = 'none';
}") ?>

<div class="small"><?php echo 'basic ' . link_to_function('markdown', "toggleMarkdownHelp()") . ' formatting allowed' ?></div>
<div id="markdown_help" style="display: none">
  <p>Phrase Emphasis</p>

  <pre><code>*italic*   **bold**
  </code></pre>

  <p>Manual Line Breaks</p>

  <p>End a line with two or more spaces:</p>

  <pre><code>Roses are red,   
  Violets are blue.
  </code></pre>

  <p>Images (titles are optional):</p>

  <pre><code>![alt text](/path/img.jpg "Title")
  </code></pre>

  <p>Lists:</p>

  <pre><code>*   stuff
      * thing
  *   whatchamacallit
      1.  thingy
      2.  thingumajig
          * what's-his-name
  </code></pre>

  <p>Links:</p>

  <pre><code>An [example](http://url.com/ "Title")
  </code></pre>

  <p>Blockquotes</p>

  <pre><code>&gt; Email-style angle brackets
  &gt; are used for blockquotes.

  &gt; &gt; And, they can be nested.
  </code></pre>
</div>
