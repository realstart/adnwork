<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://adnlist.com</loc>              
        <priority>0.9</priority>
    </url>
    <url>
        <loc>https://adnlist.com/login</loc>            
        <priority>0.9</priority>
    </url><url>
        <loc>https://adnlist.com/aboutus</loc>             
        <priority>0.9</priority>
    </url><url>
        <loc>https://adnlist.com/register</loc>            
        <priority>0.9</priority>
    </url><url>
        <loc>https://adnlist.com/contactus</loc>        
        <priority>0.9</priority>
    </url>
    @foreach ($all_posts as $item)
        <url>
            <loc>https://adnlist.com/category_view/detail/{{ $item->id }}/all</loc>
            <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>            
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>