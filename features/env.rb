require 'webrat'
require 'webrat/mechanize'

class MechanizeWorld < Webrat::MechanizeSession
  require 'spec'
  include Spec::Matchers
end

World do
  MechanizeWorld.new
  # include Webrat::Matchers
end