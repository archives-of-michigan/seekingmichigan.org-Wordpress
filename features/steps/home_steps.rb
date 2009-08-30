Then /^the page should load successfully/ do
  response_code.should >= 200
  response_code.should < 300
end

Then /^I should see a link to the (.+) page$/ do |link|
  matches = response_body.scan(/<a.*href="(.*)".*>/)
  found = false
  matches.each do |match|
    found = true if match[0] == link
  end
end

Then /^I should see a featured collection$/ do
  response_body.should have_tag("div#discover-bar div.wrapper h3 a[href=/discover-collection?collection=p4006coll7]")
end
